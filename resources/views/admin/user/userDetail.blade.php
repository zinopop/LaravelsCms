@extends('layouts.admin.common')

@section('title','用户详情')

@section('header')
    @parent
    <link href="{{ asset('hplus1') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style-self.css" rel="stylesheet">
@endsection

@section('wrapper')
    @parent
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form method="get" class="form-horizontal" id="myForm">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="user" value="{{ isset($data['user']['user']) ? $data['user']['user'] : ''}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">用户昵称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nickname" value="{{ isset($data['user']['nickname']) ? $data['user']['nickname'] : ''}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">权限组</label>
                            <div class="col-sm-10">
                                <select class="form-control" multiple="" name="group_set">
                                    @isset($data['group'])
                                        @if(isset($data['user']['group_set']))
                                            @foreach($data['group'] as $k => $v)
                                                <option value="{{ $v['id'] }}" {{ in_array($v['id'],json_decode($data['user']['group_set'])) ? 'selected' : '' }}>{{ $v['group_name'] }}</option>
                                            @endforeach
                                        @else
                                            @foreach($data['group'] as $k => $v)
                                                <option value="{{ $v['id'] }}">{{ $v['group_name'] }}</option>
                                            @endforeach
                                        @endif
                                    @endisset
                                </select>
                                <span class="help-block m-b-none">可多选</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" name="id" value="{{ isset($data['user']['id'])? $data['user']['id'] : ''  }}">
                        {{ csrf_field() }}
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
    <script src="{{ asset('hplus1') }}/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{ asset('hplus1') }}/js/plugins/validate/messages_zh.min.js"></script>
    <script>
        $(function () {

        });
        var saveObj = function () {
            var _saveObj = new Object();
            _saveObj.save = function () {
                var re = new Object();
                var data = $("#myForm").serializeObject();
                data['group_set'] = $("#myForm").find("select[name='group_set']").val();
                if(validateTips([{
                    data:data.user,
                    message:'用户名不能为空',
                    choose:$("#myForm").find("input[name='user']")
                },{
                    data:data.nickname,
                    message:'昵称不能为空',
                    choose:$("#myForm").find("input[name='nickname']")
                }]) > 0){
                    return {'code':500,'msg':'填写信息有误'};
                };
                if(getQueryString('id') != ''){
                    //编辑
                    data['submit_type'] = 'edit';
                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.user.userDataSave') }}',
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
                }else{
                    //新增
                    data['submit_type'] = 'add';
                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.user.userDataSave') }}',
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
                }
                return re;

            };
            return _saveObj;
        };

    </script>
@endsection