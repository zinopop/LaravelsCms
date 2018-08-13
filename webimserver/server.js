//pm2 管理模式 开启多个进程负载 同时需要配置nginx

var port = 8012 + parseInt(process.env.NODE_APP_INSTANCE);
var io = require('socket.io').listen(port);

// var io = require('socket.io').listen(8012);

var db = require('./db');
var users = [];

io.sockets.on('connection', function (socket) {
    //用户加入
    socket.on('new user',function(data){
        var user = data.user;
        users[user]= {
            user:data.user,
            id:data.id,
            nickname:data.nickname,
            socket:socket
        };
        updateUserStatus(data.id,'online').init(socket.broadcast.emit('user high lines',data));
    });

    //用户间私信的监听事件
    socket.on('private message', function (from,to,msg) {
        if(to in users){
            users[to].socket.emit('to'+to,msg);
        }
    });

    //群信息
    socket.on('group message', function (from,to,msg) {
        socket.broadcast.emit('group_to'+to,msg);
    });
    
    //监听用户自行修改上线状态
    socket.on('status update by user',function (user,nickname,id,status) {
        var data = {
            id:id,
            nickname:nickname,
            user:user
        };
        if(status == 'online'){

            updateUserStatus(data.id,'online').init(socket.broadcast.emit('user high lines',data));
        }else if(status == 'hide'){
            updateUserStatus(data.id,'offline').init(socket.broadcast.emit('user disconnected',{
                nickname:data.nickname,
                id:data.id
            }));
        }else{
            console.log('status update by user error');
        }
    });

    //用户退出
    socket.on('disconnect', function () {
        for(var i in users){
            if(users[i].socket == socket){
                updateUserStatus(users[i].id,'offline').init(socket.broadcast.emit('user disconnected',{
                    nickname:users[i].nickname,
                    id:users[i].id
                }));
            }
        }
    });
});

/*
* 更新用户在线状态
* */
var updateUserStatus = function (id,type) {
    var _updateUserStatus = new Object();
    _updateUserStatus.init = function (func) {
        db.query("UPDATE `laraveltest`.`cm_user` SET `online_status` = '"+type+"' WHERE `id` = "+id,function (err,rows) {
            if(err) return {code:'500',msg:err};
            else func;
        });
    };
    return _updateUserStatus;
};


