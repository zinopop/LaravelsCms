<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    @section('header')
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('statics') }}/login/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('statics') }}/login/css/demo.css" />
    <!--必要样式-->
    <link rel="stylesheet" type="text/css" href="{{ asset('statics') }}/login/css/component.css" />
    <link href="{{ asset('hplus1') }}/css/style-self.css" rel="stylesheet">
    <!--[if IE]>
    <script src="{{ asset('statics') }}/login/js/html5.js"></script>
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>
    @show
</head>
<body>
    <div class="container demo-1">
        @yield('content')
    </div>
    @section('global-content')

    @show

    @section('javascript-code')
    <script src="{{ asset('hplus1') }}/js/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}js/admin/config.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}js/admin/common.js" type="text/javascript"></script>
    <script src="{{ asset('statics') }}/layer/layer.js"></script>
    <script src="{{ asset('statics') }}/login/js/TweenLite.min.js"></script>
    <script src="{{ asset('statics') }}/login/js/EasePack.min.js"></script>
    <script src="{{ asset('statics') }}/login/js/rAF.js"></script>
    <script src="{{ asset('statics') }}/login/js/demo-1.js"></script>
    @show
</body>
</html>