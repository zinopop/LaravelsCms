@extends('layouts.admin.common')

@section('title',$title)

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
                        @if(!empty($filedArray))
                            @foreach($filedArray as $k => $v)
                                @if($v['type'] == 'input')
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{ $v['ch_name'] }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="{{ $k }}" value="{{ isset($data[$k]) ? $data[$k] : ''}}">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                @elseif($v['type'] == 'select')
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{ $v['ch_name'] }}</label>
                                        <div class="col-sm-10">
                                            <select name="{{ $k }}" class="form-control">
                                                @foreach($v['selectChose'] as $k2=>$v2)
                                                    <option value="{{ $v2 }}" {{ $data[$k] == $v2 ? "selected":'' }}>{{ $k2 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                @endif
                            @endforeach
                        @endif

                        <input type="hidden" name="id" value="{{ isset($data['id'])? $data['id'] : ''  }}">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="fieldJson" value="{{ isset($filed) ? $filed : '' }}">
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

        var saveObj = function () {
            var _saveObj = new Object();
            _saveObj.save = function () {
                var re = new Object();
                var data = $("#myForm").serializeObject();
                var fieldData = getFieldData().init();
                var validateTipsOption = [];
                $.each(fieldData,function (index,val) {
                    validateTipsOption.push({
                        data:$("#myForm").find("input[name='"+index+"']").val(),
                        message:val.validateTips,
                        choose:$("#myForm").find("input[name='"+index+"']")
                    });
                });
                if(validateTips(validateTipsOption) > 0){
                    return {'code':500,'msg':'填写信息有误'};
                };
                if(getQueryString('id') != ''){
                    //编辑
                    data['submit_type'] = 'edit';
                    $.ajax({
                        method: 'post',
                        url: '{{ route($prefix.'.save') }}',
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
                        url: '{{ route($prefix.'.save') }}',
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