@extends('admin.view.public.base')
@section('content')
    @include('admin.view.public.content_header')
<section class="content">


    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <!--数据列表顶部-->
                <div class="box-header">
                    <div>
                        <a title="添加" data-toggle="tooltip" class="btn btn-primary btn-sm " href="/admin/admin_role/create">
                            <i class="fa fa-plus"></i> 添加
                        </a>



                        <a class="btn btn-success btn-sm ReloadButton" data-toggle="tooltip" title="刷新"
                           data-id="checked" data-url="/">
                            <i class="fa fa-refresh"></i> 刷新
                        </a>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered datatable" width="100%">
                        <thead>
                        <tr>
                            <th>
                                <input id="dataCheckAll" type="checkbox" onclick="checkAll(this)" class="checkbox"
                                       placeholder="全选/取消">
                            </th>
                            <th>ID</th>
                            <th>名称</th>
                            <th>简介</th>

                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $item)
                        <tr>
                            <td>
                                <input type="checkbox" onclick="checkThis(this)" name="data-checkbox"
                                       data-id="{$item.id}" class="checkbox data-list-check" value="{$item.id}"
                                       placeholder="选择/取消">
                            </td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td class="td-do">
                                <a href="/admin/admin_role/access/{{$item->id}}"
                                   class="btn btn-warning btn-xs" data-toggle="tooltip" title="授权">
                                    <i class="fa fa-key"></i>
                                </a>
                                <a href="/admin/admin_role/{{$item->id}}/edit"
                                   class="btn btn-primary btn-xs" title="修改" data-toggle="tooltip">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a class="btn btn-danger btn-xs AjaxButtonDelete" data-toggle="tooltip" title="删除"
                                   data-id="{{$item->id}}" data-confirm-title="删除确认"
                                   data-confirm-content='您确定要删除ID为 <span class="text-red">{{$item->id}}</span> 的数据吗'
                                   data-url="/admin/admin_role/{{$item->id}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                                </a>
                            </td>
                        </tr>
                      @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- 数据列表底部 -->
                <div class="box-footer">
                 {!! $page !!}

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

