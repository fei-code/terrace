@if(isPjax1() == false)
        <!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    @endif
    <title> @yield('title','Admin')</title>
    @if(isPjax1() == false)
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin.view.public.head_css')
        @include('admin.view.public.head_js')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@endif
<!-- 顶部 -->
@include('admin.view.public.header')
<!-- 左侧 -->
@include('admin.view.public.sidebar')
<!-- 内容 -->
    <div class="content-wrapper" id="pjax-container">
        @yield('content')
    </div>
    @include('admin.view.public.footer')
    @include('admin.view.public.control_sidebar')
    @if(isPjax1() == false)
</div>
@endif
@if(isPjax1() == false)
</body>
</html>
@endif