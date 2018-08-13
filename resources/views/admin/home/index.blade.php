@extends('layouts.admin.home')

@section('header')
    @parent

@endsection

@section('wrapper')
    @parent
    <!--左侧导航开始-->
    @include('include.admin.home.navbar-default')
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    @include('include.admin.home.page-wrapper')
    <!--右侧部分结束-->

    <!--右侧边栏开始-->
    {{--@include('include.admin.home.right-sidebar')--}}
    <!--右侧边栏结束-->

    <!--mini聊天窗口开始-->
    {{--@include('include.admin.home.small-chat-box')--}}
@endsection

@section('javascript-code')
    @parent

@endsection