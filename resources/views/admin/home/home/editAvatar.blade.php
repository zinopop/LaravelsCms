@extends('layouts.admin.common')

@section('title','修改头像')

@section('header')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('statics/webuploader') }}/webuploader.css">
@endsection

@section('wrapper')
    @parent
    <div id="uploader" class="wu-example">
        <!--用来存放文件信息-->
        <div id="thelist" class="uploader-list"></div>
        <div class="btns">
            <div id="picker">选择文件</div>
            <button id="ctlBtn" class="btn btn-default">开始上传</button>
            <button id="reBtn" class="btn btn-default">重置</button>
        </div>
    </div>
@endsection

@section('javascript-code')
    @parent
    <script type="text/javascript" src="{{ asset('statics/webuploader') }}/webuploader.js"></script>
    <script>
        $("#ctlBtn").click(function () {
            uploader.upload();
        });
        //重置
        $("#reBtn").click(function () {
            uploader.reset();
            $("#thelist").empty();
        });
        //
        var uploader = WebUploader.create({

            // swf文件路径
            swf: '{{ asset('statics/webuploader') }}/Uploader.swf',

            // 文件接收服务端。
            server: '{{ route('admin.home.home.uploadAvatar') }}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id:'#picker',
                multiple:false,
            },

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            //上传数据
            method:'post',
            formData:{
                _token:'{{ csrf_token() }}'
            },
            accept:{
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            //fileNumLimit:1,
        });
        // 当有文件被添加进队列的时候
        // uploader.on( 'fileQueued', function( file ) {
        //     var $list = $('#thelist');
        //     $list.append( '<div id="' + file.id + '" class="item">' +
        //         '<h4 class="info">' + file.name + '</h4>' +
        //         '<p class="state">等待上传...</p>' +
        //         '</div>' );
        // });
        uploader.on( 'fileQueued', function( file ) {
            var $list = $('#thelist');
            var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
                '</div>'
                ),
                $img = $li.find('img');
            // $list为容器jQuery实例
            $list.empty();
            $list.append( $li );
            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, 100, 100 );
        });
        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress .progress-bar');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<div class="progress progress-striped active">' +
                    '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                    '</div>' +
                    '</div>').appendTo( $li ).find('.progress-bar');
            }

            $li.find('p.state').text('上传中');

            $percent.css( 'width', percentage * 100 + '%' );
        });
        uploader.on( 'uploadSuccess', function( file ) {
            $( '#'+file.id ).find('p.state').text('已上传');
        });

        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).find('p.state').text('上传出错');
        });

        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').fadeOut();
        });
    </script>
@endsection
