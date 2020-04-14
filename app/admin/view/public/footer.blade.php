<!--页面底部-->
@if(isPjax1() ==false)
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b>{{$admin['version']??'admin'}}
    </div>
    <strong>Copyright &copy; 2019 <a href="{{$admin['link'] ?? '#'}}>{{$admin['author'] ?? 'admin'}}" ></a>.</strong> All rights
    reserved.
</footer>
@endif