@extends('layouts.admin.common')

@section('title','角色详情')

@section('header')
    @parent
    <link href="{{ asset('hplus1') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style-self.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('zTree_v3') }}/css/zTreeStyle/zTreeStyle.css" type="text/css">
@endsection

@section('wrapper')
    @parent
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="get" class="form-horizontal" id="myForm">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">角色名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="group_name" value="{{ isset($data['group_data']) ? $data['group_data']['group_name'] : '' }}">
                                <span class="help-block m-b-none">角色分组名称</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">权限节点</label>
                            <div class="col-sm-10">
                                <ul id="treeDemo" class="ztree"></ul>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ isset($data['group_data']['id']) ? $data['group_data']['id'] : '' }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-code')
    @parent
    <script src="{{ asset('hplus1') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="{{ asset('hplus1') }}/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{ asset('hplus1') }}/js/plugins/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="{{ asset('zTree_v3') }}/js/jquery.ztree.core.js"></script>
    <script type="text/javascript" src="{{ asset('zTree_v3') }}/js/jquery.ztree.excheck.js"></script>
    <script>

        $(function () {
            treeObj('treeDemo').init(getQueryString('id'));
        });

        var treeObj = function ($em) {
            var _treeObj = new Object();

            //初始化treeObj
            _treeObj.init = function (key) {
                if(key != ''){
                    $.ajax({
                        method: 'get',
                        url: '{{ route('admin.user.getRuteData') }}?groupId='+key,
                        dataType: 'json',
                        success: function(result) {
                            var setting = {
                                check: {
                                    enable: true,

                                },
                                data: {
                                    simpleData: {
                                        enable: true
                                    }
                                },
                                view:{
                                    showIcon: false
                                }
                            };
                            var zNodes = result;
                            $.fn.zTree.init($('#'+$em), setting, zNodes);
                        },
                        error: function(con) {

                        }
                    });
                }else {
                    $.ajax({
                        method: 'get',
                        url: '{{ route('admin.user.getRuteData') }}',
                        dataType: 'json',
                        success: function(result) {
                            var setting = {
                                check: {
                                    enable: true,

                                },
                                data: {
                                    simpleData: {
                                        enable: true
                                    }
                                },
                                view:{
                                    showIcon: false
                                }
                            };
                            var zNodes = result;
                            $.fn.zTree.init($('#'+$em), setting, zNodes);
                        },
                        error: function(con) {

                        }
                    });
                }

            };
            //获得tree结果
            _treeObj.getResult = function () {
                var zTree = $.fn.zTree.getZTreeObj($em);
                var result = zTree.getCheckedNodes(true);
                var re = new Array();
                result.forEach(function (currentValue, index, arr){
                    re.push(currentValue.id);
                });
                return re;
            };
            return _treeObj;
        };

        var saveObj = function () {
            var _saveObj = new Object();
            _saveObj.save = function () {
                var re = new Object();
                if(getQueryString('id') != ''){
                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.user.roleDataSave') }}',
                        data: {
                            id:getQueryString('id'),
                            group_name:$("input[name='group_name']").val(),
                            route_set:treeObj('treeDemo').getResult(),
                            _token:'{{ csrf_token() }}',
                            submit_type:'edit'
                        },
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
                }else{
                    //新增
                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.user.roleDataSave') }}',
                        async:false,
                        dataType: 'json',
                        data: {
                            group_name:$("input[name='group_name']").val(),
                            route_set:treeObj('treeDemo').getResult(),
                            _token:'{{ csrf_token() }}',
                            submit_type:'add'
                        },
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
                }
                return re;

            };
            return _saveObj;
        };

    </script>
@endsection