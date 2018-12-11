@extends('layouts.admin.common')

@section('title','计量单位')

@section('header')
    @parent
    <link href="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.css" rel="stylesheet">
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
                    <form role="form" id="search_form">
                        <div class="form-inline">
                            <div class="form-group m-r-xs">
                                <label for="exampleInputEmail2">计量单位代码</label>
                                <input type="text" name="code" class="form-control">
                            </div>
                            <div class="form-group m-r-xs">
                                <label for="exampleInputEmail2">计量单位名称</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-inline" id="form-inline">
                                <button class="btn btn-primary" type="button" id="select"><i class="fa fa-search"></i> 查询</button>
                                <button class="btn btn-primary" type="button" id="add"><i class="fa fa-plus"></i> 添加</button>
                                {{--<button class="btn btn-info" type="button"><i class="fa fa-paste"></i> 编辑</button>--}}
                                <button class="btn btn-danger " type="button" id="delete"><i class="fa fa-times"></i> <span class="bold">删除</span></button>
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
    <script>
        $(function () {

            tableObj().init();

            buttonObj().init();

        });

        /*
        * 初始化表格组件
        * */
        var tableObj = function () {
            var _tableObj = new Object();
            _tableObj.init = function () {
                $('#tb_departments').bootstrapTable({
                    url: '{{ route('admin.parameter.unit.getData') }}',         //请求后台的URL（*）
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
                    clickToSelect: false,                //是否启用点击选中行
                    // height: 500,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
                    uniqueId: "id",                     //每一行的唯一标识，一般为主键列
                    showToggle:true,                    //是否显示详细视图和列表视图的切换按钮
                    cardView: false,                    //是否显示详细视图
                    detailView: false,                   //是否显示父子表
                    columns: [{
                        checkbox: true
                    }, {
                        field: 'id',
                        title: '操作',
                        formatter:function (value,row,index) {
                            return '<a href="javascript:void(0);" onclick=editObj().init('+value+')>编辑</a>';
                        }
                    },{
                        field: 'code',
                        title: '计量单位代码'
                    },{
                        field: 'name',
                        title: '计量单位名称'
                    },{
                        field: 'enable',
                        title: '启用状态',
                        formatter:function (value,row,index) {
                            if(value=='Y') return '<select class="form-control" onchange=editForPramkey().init(this,\''+row.id+'\')><option value="Y" selected>启用</option><option value="N">停用</option></select>';
                            else if(value == 'N') return '<select class="form-control" onchange=editForPramkey().init(this,\''+row.id+'\')><option value="Y">启用</option><option value="N" selected>停用</option></select>';
                        }
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
                    code:$('#search_form').find("input[name='code']").val(),
                    name:$('#search_form').find("input[name='name']").val(),
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
                        content: '{{ route('admin.parameter.unit.detail') }}',
                        btn: ['保存', '关闭'],
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
                            //return false 开启该代码可禁止点击该按钮关闭
                        },
                        cancel: function(){
                            //右上角关闭回调
                            //return false 开启该代码可禁止点击该按钮关闭
                        },
                        end:function(){
                            $('#tb_departments').bootstrapTable('refresh');
                        },
                        success: function(layero, index){
                            //var body = layer.getChildFrame('body', index);
                        }
                    });
                });
                //查询按钮
                $("#select").click(function () {
                    $('#tb_departments').bootstrapTable('refresh');
                });
                //删除按钮
                $("#delete").click(function () {
                    var row = $('#tb_departments').bootstrapTable('getSelections');
                    var idArray = new Array();
                    layer.confirm('是否删除？', {
                        btn: ['确定','取消'] //按钮
                    }, function(){
                        if(row.length > 0 ){
                            $.each(row,function (index,val) {
                                idArray.push(val.id);
                            });
                            $.ajax({
                                method: 'post',
                                url: '{{ route('admin.parameter.unit.del') }}',
                                data: {
                                    _token:'{{ csrf_token() }}',
                                    idArray:idArray
                                },
                                async:false,
                                dataType: 'json',
                                success: function(result) {
                                    if(result.code == 200){
                                        layer.msg(result.msg);
                                        $('#tb_departments').bootstrapTable('refresh');
                                    }else{
                                        layer.msg(result.msg);
                                    }
                                },
                                error: function(con) {
                                    layer.msg('网络错误');
                                }
                            });
                        }else{
                            layer.msg('没有选中数据');
                        }

                    }, function(){
                        //取消
                    });
                });
            };
            return _buttonObj;
        };

        /*
        * 编辑按钮
        * */
        var editObj = function () {
            var _editObj = new Object();
            _editObj.init = function (primaryKey) {
                layer.open({
                    title:'修改',
                    area: ['700px', '500px'],
                    type: 2,
                    content: '{{ route('admin.parameter.unit.detail') }}?id='+primaryKey,
                    btn: ['保存', '关闭'],
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
                        //return false 开启该代码可禁止点击该按钮关闭
                    },
                    cancel: function(){
                        //右上角关闭回调
                        //return false 开启该代码可禁止点击该按钮关闭
                    },
                    end:function(){
                        $('#tb_departments').bootstrapTable('refresh');
                    },
                    success: function(layero, index){

                    }
                });
            };
            return _editObj;
        };

        /*
        * 行内状态修改
        * */
        var editForPramkey = function () {
            var _editForPramkey = new Object();
            _editForPramkey.init = function (obj,index) {
                var loadIndex = layer.load(1,{
                    shade: [0.5,'#fff']
                });
                var row = $('#tb_departments').bootstrapTable('getRowByUniqueId',index);
                $.ajax({
                    method: 'post',
                    url: '{{ route('admin.parameter.unit.save') }}',
                    data: {
                        enable:obj.value,
                        id:row.id,
                        _token:'{{ csrf_token() }}',
                        submit_type:'edit'
                    },
                    async:false,
                    dataType: 'json',
                    success: function(result) {
                        if(result.code == 200){
                            layer.close(loadIndex);
                            layer.msg(result.msg);
                            $('#tb_departments').bootstrapTable('refresh');
                        }else{
                            layer.msg(result.msg);
                        }
                    },
                    error: function(con) {
                        layer.msg('服务器内部错误-01');
                    }
                });
            };
            return _editForPramkey;
        }

    </script>
@endsection