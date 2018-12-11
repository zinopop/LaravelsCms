@extends('layouts.admin.common')

@section('title',$title)

@section('header')
    @parent
    <link href="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.css" rel="stylesheet">
@endsection

@section('wrapper')
    @parent

    <div class="form-inline" id="form-inline">
        <input type="file" id="import" onchange="importFile().do(this)">
        {{--<button class="btn btn-primary" type="button" id="select"><i class="fa fa-search"></i> 查询</button>--}}
        <button class="btn btn-primary" type="button" id="split"><i class="glyphicon glyphicon-duplicate"></i> 拆分</button>
    </div>
    <div class="form-inline" id="form-inline-2">
        <button class="btn btn-primary" type="button" id="save"><i class="glyphicon glyphicon-floppy-save"></i> 保存</button>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>拆分前一览 </h5>
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

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>拆分结果 </h5>
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
                    <table id="tb_departments_2" class="tb_departments"></table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript-code')
    @parent
    <script src="{{ asset('/') }}statics/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="{{ asset('/') }}statics/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
    <script src="{{ asset('/') }}js-xlsx/dist/xlsx.full.min.js"></script>
    <script>
        $(function () {

            //提示
            layer.open({
                title: '提示'
                ,content: '导入数据后并不会增加后端计算压力，而是利用客户机硬件资源计算拆分结果' +
                '此技术为自主研发,核心代码已加密'
                ,time:'8000'
            });

            tableObj().init();

            tableObj_2().init();

            buttonObj().init();

        });

        /*
        * 拆分表
        * */
        var tableObj_2 = function () {
            var _tableObj_2 = new Object();
            _tableObj_2.init = function () {
                $('#tb_departments_2').bootstrapTable({
                    toolbar: '#form-inline-2',                //工具按钮用哪个容器
                    striped: true,                      //是否显示行间隔色
                    cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
                    pagination: false,                   //是否显示分页（*）
                    sortable: false,                     //是否启用排序
                    sortOrder: "asc",                   //排序方式
                    sidePagination: "client",           //分页方式：client客户端分页，server服务端分页（*）
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

                    columns: columnsConfig().col2()
                });
            };
            return _tableObj_2;
        };

        /*
        * 初始化表格组件
        * */
        var tableObj = function () {
            var _tableObj = new Object();
            _tableObj.init = function () {
                $('#tb_departments').bootstrapTable({
                    toolbar: '#form-inline',                //工具按钮用哪个容器
                    striped: true,                      //是否显示行间隔色
                    cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
                    pagination: true,                   //是否显示分页（*）
                    sortable: false,                     //是否启用排序
                    sortOrder: "asc",                   //排序方式
                    sidePagination: "client",           //分页方式：client客户端分页，server服务端分页（*）
                    pageNumber:1,                       //初始化加载第一页，默认第一页
                    pageSize: 10,                       //每页的记录行数（*）
                    pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
                    search: true,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
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
                    columns: columnsConfig().init(),
                });
            };
            return _tableObj;
        };

        /*
        * 导入功能实现
        * */
        var importFile = function () {
            var _importFile = new Object();
            _importFile.do = function (obj) {
                var wb;//读取完成的数据
                var rABS = false;
                var f = obj.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var data = e.target.result;

                    if(rABS) {
                        wb = XLSX.read(btoa(_importFile.fixdata(data)), {//手动转化
                            type: 'base64'
                        });
                    } else {
                        wb = XLSX.read(data, {
                            type: 'binary'
                        });
                    }
                    //wb.SheetNames[0]是获取Sheets中第一个Sheet的名字
                    //wb.Sheets[Sheet名]获取第一个Sheet的数据
                    //console.log(JSON.stringify( XLSX.utils.sheet_to_json(wb.Sheets[wb.SheetNames[0]]) ));
                    var result = XLSX.utils.sheet_to_json(wb.Sheets[wb.SheetNames[0]],{raw :false});
                    var colconfig = columnsConfig().col();
                    var newArray = new Array();
                    $.each(result,function (index,val) {
                        var obj_2 = new Object();
                        $.each(val,function (index2,val2) {
                            obj_2[colconfig[index2]] = val2;
                        });
                        newArray.push(obj_2);
                    });
                    $('#tb_departments').bootstrapTable('load',newArray);
                };
                if(rABS) {
                    reader.readAsArrayBuffer(f);
                } else {
                    reader.readAsBinaryString(f);
                }
            };
            _importFile.fixdata = function (data) {
                var o = "",
                    l = 0,
                    w = 10240;
                for(; l < data.byteLength / w; ++l) o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l * w + w)));
                o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));
                return o;
            };
            return _importFile;
        };

        /*
        * 页面按钮初始化
        * todo 需要配合权限 后期代码完善
        * */
        var buttonObj = function () {
            var _buttonObj = new Object();
            _buttonObj.init = function () {
                //拆分按钮
                $("#split").click(function () {
                    splitTable().do();
                });
                //保存按钮
                $("#save").click(function () {
                    tableSave().save();
                });
            };
            return _buttonObj;
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
                    url: '{{ route('admin.parameter.country.save') }}',
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
        };

        /*
        * 表格列配置
        * */
        var columnsConfig = function () {
            var _columnsConfig = new Object();
            var obj = {
                '索引号':'index_num',
                '代理名称':'agency_name',
                '供应商名称':'supplier_name',
                '来源地':'origin',
                '提运单号(主单)':'transport_master_num',
                '预报日(mm/dd/yyyy)':'forecast_date',
                '到港日(mm/dd/yyyy)':'arrival_date',
                '提运单号(分单)':'transport_branch_num',
                '毛重(公斤)':'gross_weight',
                '航班号':'flight_num',
                '发票号':'invoice_num',
                '发票页数':'invoice_page',
                '航班日期(mm/dd/yyyy)':'airport_date',
                '订单号':'order_num',
                '包装证明提供日期(mm/dd/yyyy)':'packing_date',
                '件数':'num',
                '备注3':'remark3',
                '备注4':'remark4',
                '备注5':'remark5',
                '原始币种':'primitive_currency',
                '原始金额':'primitive_price',
                '收费重量':'chargeable_weight',
                '提货日期(mm/dd/yyyy)':'delivery_date'
            };
            var obj_2 = [{
                field: 'index_num',
                title: '索引号',
                formatter:function (value,row,index) {
                    return "<input type='text' name='index_num_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'agency_name',
                title: '代理名称',
                formatter:function (value,row,index) {
                    return "<input type='text' name='agency_name_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'supplier_name',
                title: '供应商名称',
                formatter:function (value,row,index) {
                    return "<input type='text' name='supplier_name_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'origin',
                title: '来源地',
                formatter:function (value,row,index) {
                    return "<input type='text' name='origin_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'transport_master_num',
                title: '提运单号(主单)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='transport_master_num_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'forecast_date',
                title: '预报日(mm/dd/yyyy)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='forecast_date_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'arrival_date',
                title: '到港日(mm/dd/yyyy)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='arrival_date_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'entry_port',
                title: '进境口岸',
                formatter:function (value,row,index) {
                    return "<select name='entry_port_"+index+"'>" +
                        @if(!empty($seaPort))
                            @foreach($seaPort as $k => $v)
                            "<option value='{{ $v->district_name }}'>{{ $v->district_name }}</option>" +
                            @endforeach
                        @endif
                        "</select>";
                }
            },{
                field: 'declaration_port',
                title: '申报口岸',
                formatter:function (value,row,index) {
                    return "<select name='declaration_port_"+index+"'>" +
                        @if(!empty($seaPort))
                            @foreach($seaPort as $k => $v)
                            "<option value='{{ $v->district_name }}'>{{ $v->district_name }}</option>" +
                            @endforeach
                        @endif
                        "</select>";
                }
            },{
                field: 'item_class',
                title: '物料分类',
                formatter:function (value,row,index) {
                    return "<select name='item_class_"+index+"'>" +
                        @if(!empty($material))
                            @foreach($material as $k => $v)
                            "<option value='{{ $v->name }}'>{{ $v->name }}</option>" +
                            @endforeach
                        @endif
                        "</select>";
                }
            },{
                field: 'is_taxation',
                title: '是否征税',
                formatter:function (value,row,index) {
                    return "<select name='is_taxation_"+index+"'>" +
                        "<option value=''>选择</option>" +
                        "<option value='是' selected>是</option>" +
                        "<option value='否'>否</option>"
                        "</select>";
                }
            },{
                field: 'transport_branch_num',
                title: '提运单号(分单)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='transport_branch_num_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'gross_weight',
                title: '毛重(公斤)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='gross_weight_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'flight_num',
                title: '航班号',
                formatter:function (value,row,index) {
                    return "<input type='text' name='flight_num_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'invoice_num',
                title: '发票号集合',
                formatter:function (value,row,index) {
                    return "<input type='text' name='invoice_num_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'invoice_num_new',
                title: '拆分发票号',
                formatter:function (value,row,index) {
                    return "<input type='text' name='invoice_num_new_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'invoice_page',
                title: '发票页数',
                formatter:function (value,row,index) {
                    return "<input type='text' name='invoice_page_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'airport_date',
                title: '航班日期(mm/dd/yyyy)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='airport_date_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'order_num',
                title: '订单号',
                formatter:function (value,row,index) {
                    return "<input type='text' name='order_num_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'packing_date',
                title: '包装证明提供日期(mm/dd/yyyy)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='packing_date_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'num',
                title: '件数',
                formatter:function (value,row,index) {
                    return "<input type='text' name='num_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'remark3',
                title: '备注3',
                formatter:function (value,row,index) {
                    return "<input type='text' name='remark3_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'remark4',
                title: '备注4',
                formatter:function (value,row,index) {
                    return "<input type='text' name='remark4_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'remark5',
                title: '备注5',
                formatter:function (value,row,index) {
                    return "<input type='text' name='remark5_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'primitive_currency',
                title: '原始币种',
                formatter:function (value,row,index) {
                    return "<input type='text' name='primitive_currency_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'primitive_price',
                title: '原始金额',
                formatter:function (value,row,index) {
                    return "<input type='text' name='primitive_price_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'primitive_price_spilt',
                title: '拆分后金额',
                formatter:function (value,row,index) {
                    return "<input type='text' name='primitive_price_spilt_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'chargeable_weight',
                title: '收费重量',
                formatter:function (value,row,index) {
                    return "<input type='text' name='chargeable_weight_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'delivery_date',
                title: '提货日期(mm/dd/yyyy)',
                formatter:function (value,row,index) {
                    return "<input type='text' name='delivery_date_"+index+"' value='"+value+"'/>"
                }
            },{
                field: 'create_user',
                title: '导入操作员',
                formatter:function (value,row,index) {
                    return '{{ session('users')['user'] }}';
                }
            },{
                field: 'create_time',
                title: '导入时间',
                formatter:function (value,row,index) {
                    return '{{ date('Y-m-d h:i:s') }}'
                }
            }];

            _columnsConfig.init = function () {
                var col = new Array();
                $.each(obj,function (index,val) {
                    col.push({
                        field: val,
                        title:index
                    })
                });
                return col;
            };

            _columnsConfig.col = function () {
                return obj;
            };



            _columnsConfig.col2 = function () {
                return obj_2;
            };
            return _columnsConfig;
        };

        /*
        * 主表拆分功能实现
        * */
        var splitTable = function () {
            var _splitTable = new Object();
            _splitTable.do = function () {
                var data = $('#tb_departments').bootstrapTable('getData');
                if(data.length <= 0) {
                    layer.msg('没有拆分数据');
                    return;
                }
                //开始处理数据
                var newArray = new Array();
                //根据发票号拆分处理数据逻辑
                $.each(data,function (index,val) {
                    var spArray = val.invoice_num.split('/');
                    var pix;
                    $.each(spArray,function (index2,val2) {
                        if(spArray.length > 1){
                            //获取第一位字符长度
                            var len1 = spArray[0].length;
                            //获取第二位字符长度
                            var len2 = spArray[1].length;
                            //获取前缀
                            if(len1 > len2 && index2 == 0){
                                pix = spArray[0].substring(0,len1-len2);
                            }

                        };

                        if(index2 == 0 || len1 == len2){
                            newArray.push({
                                index_num:val.index_num,
                                agency_name:val.agency_name,
                                supplier_name:val.supplier_name,
                                origin:val.origin,
                                transport_master_num:val.transport_master_num,
                                forecast_date:val.forecast_date,
                                arrival_date:val.arrival_date,
                                transport_branch_num:val.transport_branch_num,
                                gross_weight:val.gross_weight,
                                flight_num:(val.flight_num == undefined) ? '' : val.flight_num,
                                invoice_num:val.invoice_num,
                                invoice_num_new:val2,
                                invoice_page:val.invoice_page,
                                airport_date:val.airport_date,
                                order_num:val.order_num,
                                packing_date:val.packing_date,
                                num:val.num,
                                remark3:(val.remark3 == undefined) ? '':val.remark3,
                                remark4:(val.remark4 == undefined) ? '':val.remark4,
                                remark5:(val.remark5 == undefined) ? '':val.remark5,
                                primitive_currency:val.primitive_currency,
                                primitive_price:val.primitive_price,
                                primitive_price_spilt:Math.floor(val.primitive_price/spArray.length * 100)/100,
                                chargeable_weight:val.chargeable_weight,
                                delivery_date:val.delivery_date
                            });
                        }else{
                            newArray.push({
                                index_num:val.index_num,
                                agency_name:val.agency_name,
                                supplier_name:val.supplier_name,
                                origin:val.origin,
                                transport_master_num:val.transport_master_num,
                                forecast_date:val.forecast_date,
                                arrival_date:val.arrival_date,
                                transport_branch_num:val.transport_branch_num,
                                gross_weight:val.gross_weight,
                                flight_num:(val.flight_num == undefined) ? '' : val.flight_num,
                                invoice_num:val.invoice_num,
                                invoice_num_new:pix+''+val2,
                                invoice_page:val.invoice_page,
                                airport_date:val.airport_date,
                                order_num:val.order_num,
                                packing_date:val.packing_date,
                                num:val.num,
                                remark3:(val.remark3 == undefined) ? '':val.remark3,
                                remark4:(val.remark4 == undefined) ? '':val.remark4,
                                remark5:(val.remark5 == undefined) ? '':val.remark5,
                                primitive_currency:val.primitive_currency,
                                primitive_price:val.primitive_price,
                                primitive_price_spilt:Math.floor(val.primitive_price/spArray.length * 100)/100,
                                chargeable_weight:val.chargeable_weight,
                                delivery_date:val.delivery_date
                            });
                        }

                    });
                });
                $('#tb_departments_2').bootstrapTable('load',newArray);
                layer.msg('拆分成功');
            };

            //获取拆分表个数据并处理
            _splitTable.getData = function () {
                var data = $('#tb_departments_2').bootstrapTable('getData');
                var newData = new Array();
                $.each(data,function (index,val) {
                    var vObj = new Object();
                    $.each(val,function (index2,val2) {
                        vObj[index2] = $("input[name='"+index2+"_"+index+"']").val() != 'undefined' ? $("input[name='"+index2+"_"+index+"']").val():'';
                    });
                    vObj['entry_port'] = $("select[name='entry_port_"+index+"']").val();
                    vObj['declaration_port'] = $("select[name='declaration_port_"+index+"']").val();
                    vObj['item_class'] = $("select[name='item_class_"+index+"']").val();
                    vObj['is_taxation'] = $("select[name='is_taxation_"+index+"']").val();
                    vObj['create_user'] = '{{ session('users')['user'] }}';
                    vObj['create_time'] = formatDateTime();
                    vObj['update_user'] = '{{ session('users')['user'] }}';
                    vObj['update_time'] = formatDateTime();
                    newData.push(vObj);
                });
                return newData;
            };
            return _splitTable;
        };


        /*
        * 拆分结果表保存
        * */

        var tableSave = function () {
            var _tableSave = new Object();
            _tableSave.save = function () {
                var data = splitTable().getData();
                if(data.length <= 0){
                    layer.msg('没有数据,不可保存');
                    return;
                }
                $.ajax({
                    method: 'post',
                    url: '{{ route('admin.customs.customsSplit.splitSave') }}',
                    data: {
                        _token:'{{ csrf_token() }}',
                        reArray:data
                    },
                    async:false,
                    dataType: 'json',
                    success: function(result) {
                        layer.msg(result.msg);
                    },
                    error: function(con) {
                        layer.msg('网络错误');
                    }
                });
            };
            return _tableSave;
        };

    </script>
@endsection