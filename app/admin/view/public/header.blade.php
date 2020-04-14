<!--网页头部-->
@if(isPjax1() ==false)
<header class="main-header">
    <a class="logo">
        <span class="logo-mini">{{$admin['short_name'] ?? 'backed'}}</span>
        <span class="logo-lg"> {{$admin['name'] ?? 'Backend'}}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle ReloadButton" title="刷新页面" data-toggle="dropdown">
                        <i class="fa fa-refresh"></i>
                    </a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{$admin['user']['avatar'] ?? '/static/admin/images/avatar.png'}}" class="user-image" alt="用户头像">
                        <span class="hidden-xs">{{$admin['user']['username'] ?? 'hello'}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{$admin['user']['avatar'] ?? '/static/admin/images/avatar.png'}}" class="img-circle" alt="用户头像">
                            <p>
                                {{$admin['user']['username'] ?? 'hello'}}
                                <small>{{$admin['user']['username'] ?? 'hello'}}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{admin_url('admin_user/profile')}}" class="btn btn-default btn-flat">个人资料</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{admin_url('logout')}}" class="btn btn-default btn-flat">退出</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
@endif
