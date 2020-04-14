<!--左侧菜单-->
@if(isPjax1() ==false)
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{$admin['user']['avatar'] ?? '/static/admin/images/avatar.png'}}" class="img-circle" alt="用户头像">
            </div>
            <div class="pull-left info">
                <p>{{$admin['user']['username'] ?? 'hello'}}</p>
                <a><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <form method="get" class="sidebar-form" id="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索菜单" id="search-input">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">导航菜单</li>
            {!! get_menu_tree() !!}

        </ul>
    </section>
</aside>
@endif