{{--继承模板--}}
@extends('layouts.admin.login')


{{--头部文件开始--}}
@section('header')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('hplus1') }}/css/loading.css" />
@endsection
{{--头部文件结束--}}


{{--内容文件开始--}}
@section('content')
<div class="content">
    <div id="large-header" class="large-header">
        <canvas id="demo-canvas"></canvas>
        <div class="logo_box">
            <h3>{{ env('APP_NAME') }}</h3>
            <form id="admin-login" method="post">
                <div class="input_outer">
                    <span class="u_user"></span>
                    <input name="user" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
                </div>
                <div class="input_outer">
                    <span class="us_uer"></span>
                    <input name="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
                </div>
                {{ csrf_field() }}
                <div class="mb2"><a class="act-but submit btn-block" href="javascript:;" style="color: #FFFFFF">登录</a></div>
            </form>
        </div>
    </div>
</div>
@endsection
{{--内容文件结束--}}

{{--全局内容开始--}}
@section('global-content')
<div id="loading" style="display: none;">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>
            <div class="object" id="object_five"></div>
            <div class="object" id="object_six"></div>
            <div class="object" id="object_seven"></div>
            <div class="object" id="object_eight"></div>
            <div class="object" id="object_nine"></div>
        </div>
    </div>
</div>
@endsection
{{--全局内容结束--}}

{{--底部js代码段开始--}}
@section('javascript-code')
    @parent
    <script type="text/javascript" src="{{ asset('hplus1') }}/js/loading-main.js"></script>
    <script>
        $(function () {
            $('.btn-block').click(function () {
                new login_do().init();
            });
            document.onkeydown = function (e) {
                var e=e||event;
                var currKey=e.keyCode||e.which||e.charCode;
                if (currKey == 13){
                    new login_do().init();
                }
            }
        });

        //登陆事件触发
        var login_do = function () {
            var _login_do = new Object();
            _login_do.init = function () {
                $('#loading').css('display','block');
                $.ajax({
                    method: 'post',
                    url: server_url+'admin/login/login',
                    data: $("#admin-login").serializeObject(),
                    dataType: 'json',
                    success: function(result) {
                        if(result.code == 200){
                            layer.msg(result.msg);
                            window.setTimeout("window.location=server_url+'admin/home/index'",500);
                        }else{
                            $("#loading").fadeOut(500);
                            layer.msg(result.msg);
                        }
                    },
                    error: function(con) {
                        alert('错误:'+con);
                    }
                });
            };
            return _login_do;
        };
    </script>
@endsection
{{--底部js代码段结束--}}

