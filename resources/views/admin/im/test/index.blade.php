@extends('layouts.admin.common')

@section('title','im测试页面')

@section('header')
    @parent
    <link href="{{ asset('hplus1') }}/css/plugins/toastr/toastr.min.css" rel="stylesheet">
@endsection

@section('wrapper')
    @parent

@endsection

@section('javascript-code')
    @parent
    <script src="{{ asset('hplus1') }}/js/plugins/toastr/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <script>
        $(function () {

            $.getScript(ws_client,function (){
                var socket = io.connect(ws_url);
                var from = {
                    user:'{{ $users['user'] }}',
                    nickname:'{{ $users['nickname'] }}',
                    id:'{{ $users['id'] }}'
                };
                layui.use(['layim'], function(layim){
                    //基础配置
                    layim.config({
                        //初始化接口
                        init: {
                            url: '{{ route('admin.im.test.getFriendList') }}',
                            type:'post',
                            data: {
                                _token:'{{ csrf_token() }}'
                            }
                        }
                        //查看群员接口
                        ,members: {
                            url: '{{ route('admin.im.test.getGroupUserList') }}',
                            type:'post'
                            ,data: {
                                _token:'{{ csrf_token() }}'
                            }
                        }

                        //上传图片接口
                        ,uploadImage: {
                            url: '{{ route('admin.im.test.uploadImg') }}' //（返回的数据格式见下文）
                            ,type: 'post' //默认post
                        }

                        //上传文件接口
                        ,uploadFile: {
                            url: '{{ route('admin.im.test.uoloadFile') }}' //（返回的数据格式见下文）
                            ,type: 'post' //默认post
                        }

                        //扩展工具栏
                        ,tool: [{
                            alias: 'code'
                            ,title: '代码'
                            ,icon: '&#xe64e;'
                        }]
                        ,title: '内部通讯' //自定义主面板最小化时的标题
                        ,initSkin: '2.jpg' //1-5 设置初始背景
                        ,notice: true //是否开启桌面消息提醒，默认false
                        ,chatLog: '{{ route('admin.im.test.chatLog') }}' //聊天记录页面地址，若不开启，剔除该项即可
                        ,copyright:false

                    });

                    //监听在线状态的切换事件
                    layim.on('online', function(data){
                        socket.emit('status update by user',from.user,from.nickname,from.id,data);
                    });

                    //监听签名修改
                    layim.on('sign', function(value){
                        $.ajax({
                            method: 'post',
                            url: '{{ route('admin.im.test.updateUserSign') }}',
                            data: {
                                _token:'{{ csrf_token() }}',
                                sign:value,
                                id:from.id
                            },
                            dataType: 'json',
                            success: function(result) {
                                if(result.code == 200){
                                    layer.msg(result.msg);
                                }else{
                                    layer.msg(result.msg);
                                }
                            },
                            error: function(con) {
                                alert('错误:'+con);
                            }
                        });
                    });

                    //监听自定义工具栏点击，以添加代码为例
                    layim.on('tool(code)', function(insert){
                        layer.prompt({
                            title: '插入代码'
                            ,formType: 2
                            ,shade: 0
                        }, function(text, index){
                            layer.close(index);
                            insert('[pre class=layui-code]' + text + '[/pre]'); //将内容插入到编辑器
                        });
                    });

                    //监听layim建立就绪
                    layim.on('ready', function(res){
                        socket.emit('new user',from);
                        //用户上线
                        socket.on('user high lines',function (data) {
                            layim.setFriendStatus(data.id, 'online');
                            // layer.open({
                            //     time:2000,
                            //     shade:0,
                            //     type:0,
                            //     anim:2,
                            //     offset:'rb',
                            //     title: '系统消息'
                            //     ,content: "<b>"+data.nickname+"上线</b>"
                            // });
                            toastr.info('上线', data.nickname);
                        });
                        //用户离线
                        socket.on('user disconnected',function (data) {
                            layim.setFriendStatus(data.id, 'offline');
                            // layer.open({
                            //     time:2000,
                            //     shade:0,
                            //     type:0,
                            //     anim:2,
                            //     offset:'rb',
                            //     title: '系统消息'
                            //     ,content: "<b>"+data.nickname+"下线</b>"
                            // });
                            toastr.warning('下线', data.nickname);
                        });
                        //监听接收私信信息
                        socket.on('to'+from.user, function (data) {
                            layim.getMessage({
                                username: data.username
                                ,avatar: data.avatar
                                ,id: data.id
                                ,type: data.type
                                ,content: data.content
                            });
                        });
                        //监听群聊信息
                        @foreach(json_decode($users['group_set']) as $k => $v)
                        //监听接收群信息
                        socket.on('group_to{{ $v }}', function (data) {
                            layim.getMessage({
                                username: data.username
                                ,avatar: data.avatar
                                ,id: data.id //组群的id
                                ,type: 'group'
                                ,content: data.content
                            });
                        });
                        @endforeach
                    });
                    //监听发送消息
                    layim.on('sendMessage', function(data){
                        if(data.to.type == 'friend'){
                            socket.emit('private message',from.user,data.to.user,{
                                username:'{{ $users['nickname'] }}',
                                avatar:'{{ $users['avatar'] }}',
                                id:'{{ $users['id'] }}',
                                type:'friend',
                                content:data.mine.content
                            });
                        }else if(data.to.type == 'group'){
                            socket.emit('group message',from.user,data.to.id,{
                                username:'{{ $users['nickname'] }}',
                                avatar:'{{ $users['avatar'] }}',
                                id:data.to.id,
                                type:'group',
                                content:data.mine.content
                            });
                        }

                    });
                });
            });

        });
    </script>
@endsection
