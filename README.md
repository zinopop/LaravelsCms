# LaravelsCms
基于laravel+swoole的后台管理系统(内含im即时通讯)
需安装redis node socket.io包
swoole扩展安装请参考官网
laravels配置请参考https://segmentfault.com/a/1190000013358289#articleHeader19


版本要求:
php7.0+
mysql 8.0
redis 随意
swoole 随意
node 随意

特别注意:
node 中的ws服务端 采用pm2管理 如果对多进程没有特别要求请将server.js中
var port = 8012 + parseInt(process.env.NODE_APP_INSTANCE);
var io = require('socket.io').listen(port);
改为
var io = require('socket.io').listen(8012);

node多进程解决方案的nginx配置
upstream io_nodes {
	  ip_hash;
	  server 127.0.0.1:8012;
	  server 127.0.0.1:8013;
}


todo:
1,开发者工具中的编辑和搜索
2,swoole ws im通讯模块服务端重构(目前只用到了node socket.io)

宗旨:
只为方便以后的后台管理开发，以及为了开源贡献一份力量。高手如果可以绕过
不喜勿喷


作者:qq 305579073
    邮箱 yuzheng1117@163.com
 

