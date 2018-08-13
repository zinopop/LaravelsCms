<!DOCTYPE html>
<html>

<head>
    @section('header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ env('APP_NAME') }} - @yield('title')</title>

    <link href="{{ asset('layim') }}/layui/css/layui.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="{{ asset('hplus1') }}/css/style-self.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('hplus1') }}/css/loading.css" />
    @show
</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    @section('wrapper')

    @show
</div>
<div id="loading" style="display: none;">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_one"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_four"></div>
            <div class="object" id="object_five"></div>
            <div class="object" id="object_six"></div>
            <div class="object" id="object_seven"></div>
            <div class="object" id="object_eight"></div>
            <div class="object" id="object_nine"></div>
        </div>
    </div>
</div>
@section('javascript-code')
<script src="{{ asset('hplus1') }}/js/jquery.min.js?v=2.1.4"></script>
<script src="{{ asset('/') }}js/admin/config.js"></script>
<script src="{{ asset('/') }}js/admin/common.js"></script>
<script src="{{ asset('hplus1') }}/js/bootstrap.min.js?v=3.3.5"></script>
<script src="{{ asset('hplus1') }}/js/content.min.js?v=1.0.0"></script>
<script src="{{ asset('/') }}statics/layer/layer.js"></script>
<script src="{{ asset('layim') }}/layui/layui.js"></script>

@show
</body>

</html>