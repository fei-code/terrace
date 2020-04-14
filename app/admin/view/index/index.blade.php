
@extends('admin.view.public.base')
@section('content')
@include('admin.view.public.content_header')


<section class="content">


    <div class="row">
        <div class="pad margin no-print">
            <div class="callout callout-info">
                <h4><i class="fa fa-info"></i> 您好,{{$user['nickanem'] ?? 'hello'}}</h4>
               {{$notice_content ?? ''}}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua">
                    <i class="fa fa-user"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">后台用户</span>
                    <span class="info-box-number">1</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red">
                    <i class="fa fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">后台角色</span>
                    <span class="info-box-number">1</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green">
                    <i class="fa fa-list"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">后台菜单</span>
                    <span class="info-box-number">1</span>
                </div>
            </div>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow">
                    <i class="fa fa-keyboard-o"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">操作日志</span>
                    <span class="info-box-number">1</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <section class="col-lg-7 connectedSortable" id="sortable1">

            <div class="box sortable-widget" id="user_info">
                <div class="box-header with-border">
                    <h3 class="box-title">访问信息</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>用户系统</th>
                            <td>111</td>
                            <th>用户IP</th>
                            <td>222</td>
                        </tr>

                        <tr>
                            <th>浏览器</th>
                            <td>111</td>
                            <th>所在城市</th>
                            <td>111</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box sortable-widget" id="system_info">
                <div class="box-header with-border">
                    <h3 class="box-title">系统信息</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>服务器系统</th>
                            <td>{{$data['os']}}</td>
                            <th>服务器IP</th>
                            <td>{{$data['ip']}}</td>
                        </tr>

                        <tr>
                            <th>PHP版本</th>
                            <td>{{PHP_VERSION}}</td>
                            <th>运行内存限制</th>
                            <td>2222</td>
                        </tr>

                        <tr>
                            <th>最大文件上传限制</th>
                            <td>2222</td>
                            <th>单次上传数量限制</th>
                            <td>1111</td>
                        </tr>

                        <tr>
                            <th>最大POST限制</th>
                            <td>1111</td>
                            <th>项目磁盘剩余容量</th>
                            <td>2222</td>
                        </tr>

                        <tr>
                            <th>ThinkPHP版本</th>
                            <td>{{app()->version()}}</td>
                            <th>后台系统版本</th>
                            <td>1111</td>
                        </tr>

                        <tr>
                            <th>MySql版本</th>
                            <td>{{$data['mysql_version'] }}</td>
                            <th>PHP当前运行模式</th>
                            <td>1111</td>
                        </tr>

                        <tr>
                            <th>PHP当前时区</th>
                            <td>1111</td>
                            <th>PHP当前时间</th>
                            <td>1111</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="col-lg-5 connectedSortable" id="composer_info">
            <div class="box sortable-widget" id="widget2">
                <div class="box-header with-border">
                    <h3 class="box-title">依赖关系</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>

<script>
    var passwordDanger =0;
    var sortableChanged = false;
    var sortableIds = [];

    $(function () {

        $('.connectedSortable').sortable({
            placeholder: 'sort-highlight',
            connectWith: '.connectedSortable',
            handle: '.box-header',
            forcePlaceholderSize: true,
            zIndex: 999999,
            update: function (event, ui) {
                sortableChanged = true;
                let ids1 = $('#sortable1').sortable('toArray');
                let ids2 = $('#sortable2').sortable('toArray');
                $.each(ids2, function (index, item) {
                    ids1.push(item);
                });

                sortableIds = ids1;
                console.log(sortableIds);

                /* $.ajax({
                     type: "post",
                     url: "",
                     data: {image_ids},
                     dataType: "json",
                     success: function(result) {
                         window.location.reload(); //后台获取到数据刷新页面
                     }
                 });*/
            }

        });
        $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

        //密码修改检查
        if (parseInt(passwordDanger) === 1) {
            layer.confirm('系统检测到超级管理员默认密码未修改，是否马上去修改？', {title: '风险提示', closeBtn: 1, icon: 7}, function () {
                $.pjax({
                    url: '/admin/admin_user/profile.html#privacy',
                    container: '#pjax-container'
                });
                layer.closeAll();
            });
        }
    });

</script>
@endsection