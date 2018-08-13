
@extends('layouts.admin.common')

@section('title','错误')

@section('header')
@parent

@endsection

@section('wrapper')
@parent
<div class="middle-box text-center animated fadeInDown">
    <h2>500</h2>
    <h2 class="font-bold">
        @if(session('msg'))
            {{ session('msg') }}
        @endif
    </h2>

    <div class="error-desc">
        服务器内部返回
        {{--<br/><a href="index.html" class="btn btn-primary m-t">主页</a>--}}
    </div>
</div>
@endsection

@section('javascript-code')
@parent


@endsection