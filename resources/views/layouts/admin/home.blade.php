<!DOCTYPE html>
<html>

<head>
    @section('header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
        <title>清关通 关务管理系统 - 主页</title>
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link href="{{ asset('hplus1') }}/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style-self.css" rel="stylesheet">
    @show
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    @section('wrapper')

    @show
</div>
@section('javascript-code')
<script src="{{ asset('hplus1') }}/js/jquery.min.js?v=2.1.4"></script>
<script src="{{ asset('hplus1') }}/js/bootstrap.min.js?v=3.3.5"></script>
<script src="{{ asset('hplus1') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('hplus1') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('hplus1') }}/js/plugins/layer/layer.min.js"></script>
<script src="{{ asset('hplus1') }}/js/hplus.min.js?v=4.0.0"></script>
<script type="text/javascript" src="{{ asset('hplus1') }}/js/contabs.min.js"></script>
<script src="{{ asset('hplus1') }}/js/plugins/pace/pace.min.js"></script>
@show
</body>

</html>