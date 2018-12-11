@extends('layouts.admin.common')

@section('title',$title)

@section('header')
    @parent
    <link href="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('statics/webuploader') }}/webuploader.css">
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
                            @if(!empty($filedArray))
                                @foreach($filedArray as $k => $v)
                                    @if($v['type'] == 'input')
                                        <div class="form-group m-r-xs">
                                            <label for="exampleInputEmail2">{{ $v['ch_name'] }}</label>
                                            <input type="text" name="{{ $k }}" class="form-control">
                                        </div>
                                    @elseif($v['type'] == 'select')
                                        <div class="form-group m-r-xs">
                                            <label for="exampleInputEmail2">{{ $v['ch_name'] }}</label>
                                            <select name="{{ $k }}" class="form-control">
                                                @foreach($v['selectChose'] as $k2=>$v2)
                                                    <option value="{{ $v2 }}">{{ $k2 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="form-inline" id="form-inline">
                                <div id="import"></div>
                                {{--<button class="btn" type="button" id="import"><i class="glyphicon glyphicon-import"></i> 导入</button>--}}
                                <button class="btn btn-primary" type="button" id="export"><i class="glyphicon glyphicon-export"></i> 导出</button>
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
    <input type="hidden" name="fieldJson" value="{{ isset($filed) ? $filed : '' }}">
@endsection

@section('javascript-code')
    @parent
    <script src="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="{{ asset('/') }}statics/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
    <script type="text/javascript" src="{{ asset('statics/webuploader') }}/webuploader.js"></script>
    <script>
        $(function () {
            var fieldData = getFieldData().init();
            tableObj().init(fieldData);

            buttonObj().init();

        });


        var uploader = WebUploader.create({
            auto : true,
            // swf文件路径
            swf: '{{ asset('statics/webuploader') }}/Uploader.swf',

            // 文件接收服务端。
            server: '{{ route($prefix.'.import') }}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            // pick: '#import-file',
            pick: {
                id:'#import',
                label:'导入'
            },

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            //上传数据
            method:'post',
            formData:{
                _token:'{{ csrf_token() }}'
            },
        });
        uploader.on( 'uploadSuccess', function( file ) {
            layer.msg('导入完成');
        });

        uploader.on( 'uploadError', function( file ) {
            layer.msg('导入失败');
        });

        uploader.on( 'uploadComplete', function( file ) {
            uploader.reset();
            $('#tb_departments').bootstrapTable('refresh');
        });
        /*
        * 下载功能
        * */
        var download = function () {
            var _download = new Object();
            _download.do = function (url) {
                window.open(url);
            };
            return _download;
        };
        /*
        * 导入功能
        * */
        var importFile = function () {
            var _importFile = new Object();
            _importFile.do = function () {

            };
            return _importFile;
        };
        /*
        * 导出功能
        * */
        var exportFile = function () {
            var _exportFile = new Object();
            _exportFile.do = function () {
                $.ajax({
                    method: 'post',
                    url: '{{ route($prefix.'.export') }}',
                    data: {
                        _token:'{{ csrf_token() }}'
                    },
                    async:false,
                    dataType: 'json',
                    success: function(result) {
                        if(result.code == 200){
                            download().do(result.url);
                            layer.msg(result.msg);
                        }else{
                            layer.msg(result.msg);
                        }
                    },
                    error: function(con) {
                        layer.msg('网络错误');
                    }
                });
            };
            return _exportFile;
        };
        /*
        * 获取列数据
        * */
        var getFieldData = function () {
            var _getFieldData = new Object();
            _getFieldData.init = function () {
                var data = $("input[name='fieldJson']").val();
                return eval('(' + data + ')');
            };
            return _getFieldData;
        };

        /*
        * 初始化表格组件
        * */
        var tableObj = function () {
            var _tableObj = new Object();
            _tableObj.init = function (fieldData) {
                var tableColumns = [{
                    checkbox: true
                }, {
                    field: 'id',
                    title: '操作',
                    formatter:function (value,row,index) {
                        return '<a href="javascript:void(0);" onclick=editObj().init('+value+')>编辑</a>';
                    }
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
                } ];

                var ii = 0;
                $.each(fieldData,function (index,val) {
                    tableColumns.splice(2+ii,0,{
                        field: index,
                        title: val.ch_name
                    });
                    ii ++;
                });

                $('#tb_departments').bootstrapTable({
                    url: '{{ route($prefix.'.getData') }}',         //请求后台的URL（*）
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
                    columns:tableColumns
                });
            };
            _tableObj.queryParams = function (params) {
                var fieldData = getFieldData().init();
                var temp = {   //这里的键的名字和控制器的变量名必须一直，这边改动，控制器也需要改成一样的
                    limit: params.limit,   //页面大小
                    offset: params.offset,  //页码
                    // enterprise_short_code:$('#search_form').find("input[name='enterprise_short_code']").val(),
                    // ch_full_name:$('#search_form').find("input[name='ch_full_name']").val(),
                    // en_full_name:$('#search_form').find("input[name='en_full_name']").val(),
                    // ten_num:$('#search_form').find("input[name='ten_num']").val(),
                    // unified_num:$('#search_form').find("input[name='unified_num']").val(),
                    _token:'{{ csrf_token() }}'
                };

                $.each(fieldData,function (index,val) {
                    temp[index] = $('#search_form').find(val.type+"[name='"+index+"']").val();
                });
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
                        content: '{{ route($prefix.'.detail') }}',
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
                                url: '{{ route($prefix.'.del') }}',
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
                //导入按钮
                $("#import").click(function () {
                    importFile().do();
                });
                //导出按钮
                $("#export").click(function () {
                    exportFile().do();
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
                    content: '{{ route($prefix.'.detail') }}?id='+primaryKey,
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
                    url: '{{ route($prefix.'.save') }}',
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