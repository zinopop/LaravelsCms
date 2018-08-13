@extends('layouts.admin.common')

@section('title','路由菜单列表')

@section('header')
    @parent
    <link href="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@endsection

@section('wrapper')
    @parent
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>搜索栏</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="form_basic.html#">选项1</a>
                            </li>
                            <li><a href="form_basic.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form role="form">
                        <div class="form-inline">
                            <div class="form-group m-r-xs">
                                <label for="exampleInputEmail2">路由名称</label>
                                <input type="email" placeholder="请输入用户名" id="exampleInputEmail2" class="form-control">
                            </div>
                            <div class="form-group m-r-xs">
                                <label for="exampleInputPassword2">控制器名称</label>
                                <input type="password" placeholder="请输入密码" id="exampleInputPassword2" class="form-control">
                            </div>
                            {{--<div class="form-group m-r-xs"id="data_1">--}}
                            {{--<label>日期选择</label>--}}
                            {{--<div class="input-group date">--}}
                            {{--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>--}}
                            {{--<input type="text" class="form-control" value="2014-11-11">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group m-r-xs" id="data_5">
                                <label>范围选择</label>
                                <div class="input-daterange input-group date" id="datepicker">
                                    <span class="input-group-addon date-icon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="start" value="2014-11-11">
                                    <span class="input-group-addon">到</span>
                                    <span class="input-group-addon date-icon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="end" value="2014-11-17">
                                </div>
                            </div>

                            <div class="form-group m-r-xs">
                                <label>路由类型</label>
                                <select class="form-control" name="account">
                                    <option>选项 1</option>
                                    <option>选项 2</option>
                                    <option>选项 3</option>
                                    <option>选项 4</option>
                                </select>
                            </div>
                            <div class="form-inline" id="form-inline">
                                <button class="btn btn-primary" type="button"><i class="fa fa-search"></i> 查询</button>
                                <button class="btn btn-primary" type="button" id="add"><i class="fa fa-plus"></i> 添加</button>
                                {{--<button class="btn btn-info" type="button"><i class="fa fa-paste"></i> 编辑</button>--}}
                                <button class="btn btn-danger " type="button"><i class="fa fa-times"></i> <span class="bold">删除</span></button>
                                {{--<button class="btn btn-default" type="button">确定</button>--}}

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>基本 </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_data_tables.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="table_data_tables.html#">选项1</a>
                            </li>
                            <li><a href="table_data_tables.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table id="tb_departments" class="tb_departments"></table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-code')
    @parent
    <script src="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="{{ asset('/') }}statics/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
    <script src="{{ asset('hplus1') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <script>
        $(function () {
            //初始化日期
            datepick().init();

            tableObj().init();

            buttonObj().init();
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

        /*
        * 初始化表格组件
        * */
        var tableObj = function () {
            var _tableObj = new Object();
            _tableObj.init = function () {
                $('#tb_departments').bootstrapTable({
                    url: '{{ route('admin.develop.getRouteData') }}',         //请求后台的URL（*）
                    method: 'post',                      //请求方式（*）
                    toolbar: '#form-inline',                //工具按钮用哪个容器
                    striped: true,                      //是否显示行间隔色
                    cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
                    pagination: true,                   //是否显示分页（*）
                    sortable: false,                     //是否启用排序
                    sortOrder: "asc",                   //排序方式
                    queryParams: _tableObj.queryParams,//传递参数（*）
                    sidePagination: "server",           //分页方式：client客户端分页，server服务端分页（*）
                    pageNumber:1,                       //初始化加载第一页，默认第一页
                    pageSize: 10,                       //每页的记录行数（*）
                    pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
                    search: false,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
                    strictSearch: true,
                    showColumns: true,                  //是否显示所有的列
                    showRefresh: true,                  //是否显示刷新按钮
                    minimumCountColumns: 2,             //最少允许的列数
                    clickToSelect: true,                //是否启用点击选中行
                    // height: 500,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
                    uniqueId: "ID",                     //每一行的唯一标识，一般为主键列
                    showToggle:true,                    //是否显示详细视图和列表视图的切换按钮
                    cardView: false,                    //是否显示详细视图
                    detailView: false,                   //是否显示父子表
                    columns: [{
                        checkbox: true
                    }, {
                        field: 'id',
                        title: 'id'
                    }, {
                        field: 'route_name',
                        title: '路由名称'
                    }, {
                        field: 'route_ico',
                        title: 'ico图标',
                        formatter:function (value,row,index) {
                            return '<i class="'+value+'"></i>';
                        }
                    }, {
                        field: 'route_type',
                        title: '路由类型'
                    }, {
                        field: 'route_button_set',
                        title: '按钮权限'
                    }, {
                        field: 'route_url',
                        title: '地址'
                    }, {
                        field: 'route_namespace',
                        title: '命名空间'
                    }, {
                        field: 'route_controller_namespace',
                        title: '控制器所在域'
                    }, {
                        field: 'route_request_type',
                        title: '路由访问方式'
                    }, {
                        field: 'route_controller',
                        title: '控制器名称'
                    }, {
                        field: 'route_method',
                        title: '方法名'
                    }, {
                        field: 'route_as',
                        title: '路由别名'
                    }, {
                        field: 'route_middleware',
                        title: '挂载中间件'
                    }, {
                        field: 'enable',
                        title: '启用状态'
                    }, {
                        field: 'create_user',
                        title: '创建人'
                    }, {
                        field: 'create_time',
                        title: '创建时间'
                    }, {
                        field: 'update_user',
                        title: '最后更新人'
                    }, {
                        field: 'update_time',
                        title: '最后更新时间'
                    } ]
                });
            };
            _tableObj.queryParams = function (params) {
                var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
                    limit: params.limit,   //页面大小
                    offset: params.offset,  //页码
                    _token:'{{ csrf_token() }}'
                };
                return temp;
            };
            return _tableObj;
        };

        /*
        * 页面按钮初始化
        * todo 需要配合权限 后期代码完善
        * */
        var buttonObj = function () {
            var _buttonObj = new Object();
            _buttonObj.init = function () {
                $("#add").click(function () {
                    layer.open({
                        title:'添加',
                        area: ['700px', '500px'],
                        type: 2,
                        content: '{{ route('admin.develop.routeAdd') }}',
                        btn: ['保存', '重置', '关闭'],
                        closeBtn:2,
                        maxmin:true,
                        yes: function(index, layero){
                            var loadIndex = layer.load(1,{
                                shade: [0.5,'#fff']
                            });
                            //按钮【按钮一】的回调
                            var iframeWin = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();
                            var state = iframeWin.saveObj().save();
                            if(state.code == 200){
                                layer.close(loadIndex);
                                layer.msg(state.msg);
                                layer.close(index);
                            }else{
                                layer.msg(state.msg);
                                layer.close(loadIndex);
                            }
                        },
                        btn2: function(index, layero){
                            //按钮【按钮二】的回调
                            alert(2);
                            //return false 开启该代码可禁止点击该按钮关闭
                        },
                        btn3: function(index, layero){
                            //按钮【按钮三】的回调
                            alert(3);
                            //return false 开启该代码可禁止点击该按钮关闭
                        },
                        cancel: function(){
                            //右上角关闭回调
                            alert(4);
                            //return false 开启该代码可禁止点击该按钮关闭
                        },
                        end:function(){
                            $('#tb_departments').bootstrapTable('refresh');
                        },
                        success: function(layero, index){
                            var body = layer.getChildFrame('body', index);

                            //body.find('input').val('Hi，我是从父页来的');
                        }
                    });
                });
            };
            return _buttonObj;
        };

    </script>
@endsection