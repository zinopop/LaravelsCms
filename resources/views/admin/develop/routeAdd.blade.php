<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>清关通 关务管理系统 - 路由菜单管理</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="{{ asset('hplus1') }}/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style-self.css" rel="stylesheet">
    <link href="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.css" rel="stylesheet">
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="get" class="form-horizontal" id="myForm">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">路由名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_name">
                                <span class="help-block m-b-none">你的路由名称会显示在你的左侧菜单或者权限列表中</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">父级菜单</label>
                            <div class="col-sm-10">
                                <select data-placeholder="选择省份..." class="chosen-select" style="width:350px;" tabindex="2" name="parent_id">
                                    <option value="0">自父级</option>
                                    @foreach($data['route_list'] as $k => $v)
                                        <option value="{{ $v['id'] }}" hassubinfo="true">{{ $v['route_name'] }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block m-b-none">如果选择父级那么就为左侧主菜单</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">ico图标</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_ico" value="#">
                                <span class="help-block m-b-none">ico图标为左侧主菜单的显示图标默认为"#"</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">路由类型</label>

                            <div class="col-sm-10">
                                <select class="form-control m-b" name="route_type">
                                    @foreach($data['route_type'] as $k => $v)
                                    <option value="{{ $v }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block m-b-none">路由类型绝对路由的体现方式</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">按钮权限</label>

                            <div class="col-sm-10">
                                <select class="form-control" multiple="" name="route_button_set">
                                    <option value="add">add</option>
                                    <option value="del">del</option>
                                    <option value="edit">edit</option>
                                    <option value="select">select</option>
                                </select>
                                <span class="help-block m-b-none">可多选</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">url地址</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_url" value="#">
                                <span class="help-block m-b-none">访问的url</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">控制器域</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_namespace" value="Admin">
                                <span class="help-block m-b-none">控制器最外层的域</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">控制器命名空间</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_controller_namespace" value="#">
                                <span class="help-block m-b-none">控制器命名空间默认'#'</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">路由访问方式</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="route_request_type">
                                    <option value="get">get</option>
                                    <option value="post">post</option>
                                    <option value="any">any</option>
                                    <option value="put">put</option>
                                    <option value="delete">delete</option>
                                </select>
                                <span class="help-block m-b-none">请求方式</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">控制器名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_controller" value="#">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">方法名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_method" value="#">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">路由别名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="route_as" value="#">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">挂载中间件</label>
                            <div class="col-sm-10">
                                <select class="form-control" multiple="" name="route_middleware">
                                    <option value="check.admin.login">check.admin.login</option>
                                    <option value="check.admin.login.ajax">check.admin.login.ajax</option>
                                    <option value="role.auth">role.auth</option>
                                    <option value="role.auth.ajax">role.auth.ajax</option>
                                </select>
                                <span class="help-block m-b-none">可多选</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">启用状态</label>
                            <div class="col-sm-10">
                                <div class="checkbox i-checks">
                                    <label><input type="checkbox" value="Y" checked="" name="enable"> <i></i>选中为启用</label>
                                </div>

                            </div>
                        </div>
                        {{ csrf_field() }}
                        <input type="hidden" name="submit_type" value="{{ $data['submit_type'] }}">
                        <input type="hidden" name="id" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('hplus1') }}/js/jquery.min.js?v=2.1.4"></script>
<script src="{{ asset('/') }}js/admin/config.js"></script>
<script src="{{ asset('/') }}js/admin/common.js"></script>
<script src="{{ asset('hplus1') }}/js/bootstrap.min.js?v=3.3.5"></script>
<script src="{{ asset('hplus1') }}/js/content.min.js?v=1.0.0"></script>
<script src="{{ asset('hplus1') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="{{ asset('hplus1') }}/js/plugins/iCheck/icheck.min.js"></script>
<script src="{{ asset('hplus1') }}/js/plugins/chosen/chosen.jquery.js"></script>
<script src="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.js"></script>
<script src="{{ asset('/') }}statics/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
<script src="{{ asset('/') }}statics/layer/layer.js"></script>
<script>
    $(function () {
        //初始化日期
        datepick().init();

        $(".i-checks").iCheck({
            checkboxClass:"icheckbox_square-green",
            radioClass:"iradio_square-green",
        });

        $('.chosen-select').chosen();
    });


    /*
    * 初始化日期插件
    * */
    var datepick = function () {
        var _datepick = new Object();
        _datepick.init = function () {
            //datepicker
            $(".input-group.date").datepicker({
                todayBtn: "linked",
                keyboardNavigation: !1,
                forceParse: !1,
                calendarWeeks: !0,
                autoclose: !0
            });
            $(".input-daterange").datepicker({
                keyboardNavigation: !1,
                forceParse: !1,
                autoclose: !0
            });
        };
        return _datepick;
    };

    var saveObj = function () {
        var _saveObj = new Object();
        _saveObj.save = function () {
            var data = $("#myForm").serializeObject();
            data['route_middleware'] = $("select[name='route_middleware']").val();
            data['route_button_set'] = $("select[name='route_button_set']").val();
            var re = new Object();
            $.ajax({
                method: 'post',
                url: '{{ route('admin.develop.saveData') }}',
                data: data,
                async:false,
                dataType: 'json',
                success: function(result) {
                    re = result;
                },
                error: function(con) {
                    re = {
                        'code':500,
                        'msg':'请求错误'
                    };
                }
            });
            return re;
        };
        return _saveObj;
    };

</script>
</body>

</html>