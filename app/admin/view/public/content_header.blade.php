<!--内容头部-->
<section class="content-header">
    <h1>
        {{$admin['title'] ?? 'admin'}}

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active"> {{$admin['title'] ?? 'Admin'}}</li>
    </ol>
</section>


@if(isset($Think) &&$Think['session']['error_message'])
<!--如果有错误或者成功的消息-->
<script>
    layer.msg('{{$Think['session']['error_message']}}',{icon:2});
    $.pjax({
        url: "{{$Think['session']['url']}}",
        container: '#pjax-container'
    });
</script>
@endif
@if(isset($Think) &&$Think['session']['success_message'])

<script>
    layer.msg('{{$Think['session']['success_message']}}',{icon:1});
    $.pjax({
        url: '{{$Think['session']['url']}}',
        container: '#pjax-container'
    });
</script>
@endif

