@extends('layouts.admin.common')

@section('title','详情')

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
                            <label class="col-sm-2 control-label">编码</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="code" value="{{ isset($data['code']) ? $data['code'] : ''}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">中文名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="chinese_name" value="{{ isset($data['chinese_name']) ? $data['chinese_name'] : ''}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">英文名称</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="en_name" value="{{ isset($data['en_name']) ? $data['en_name'] : ''}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" name="id" value="{{ isset($data['id'])? $data['id'] : ''  }}">
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
            $(".i-checks").iCheck({
                checkboxClass:"icheckbox_square-green",
                radioClass:"iradio_square-green",
            });
        });
        var saveObj = function () {
            var _saveObj = new Object();
            _saveObj.save = function () {
                var re = new Object();
                var data = $("#myForm").serializeObject();
                if(validateTips([{
                    data:data.chinese_name,
                    message:'中文名称不能为空',
                    choose:$("#myForm").find("input[name='chinese_name']")
                },{
                    data:data.en_name,
                    message:'英文名称不能为空',
                    choose:$("#myForm").find("input[name='en_name']")
                },{
                    data:data.code,
                    message:'代码不能为空',
                    choose:$("#myForm").find("input[name='code']")
                }]) > 0){
                    return {'code':500,'msg':'填写信息有误'};
                };
                if(getQueryString('id') != ''){
                    //编辑
                    data['submit_type'] = 'edit';
                    $.ajax({
                        method: 'post',
                        url: '{{ route('admin.parameter.country.save') }}',
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
                        url: '{{ route('admin.parameter.country.save') }}',
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