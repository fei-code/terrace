@extends('admin.view.public.base')
@section('content')
    @include('admin.view.public.content_header')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <!-- 表单头部 -->
                    <div class="box-header with-border">
                        <div class="btn-group">
                            <a class="btn flat btn-sm btn-default BackButton">
                                <i class="fa fa-arrow-left"></i>
                                返回
                            </a>
                        </div>
                    </div>
                    <form id="dataForm" class="form-horizontal dataForm"
                          @if(isset($data)) action="/admin/admin_role/{{$data->id}}"
                          @else
                          action="/admin/admin_role"
                          @endif
                    method="post"
                    enctype="multipart/form-data">
                        @if(isset($data))
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">角色名称</label>
                            <div class="col-sm-10 col-md-4">
                                <input maxlength="50" id="name" name="name" value="{{$data->name ?? '' }}"
                                       class="form-control" placeholder="请输入名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-10 col-md-4">
                                <input maxlength="50" id="description" name="description"
                                       value="{{$data->description ?? ''}}" class="form-control" placeholder="请输入简介">
                            </div>
                        </div>
                    </div>
                            <!--表单底部-->
                    <div class="box-footer">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-10 col-md-4">
                            <div class="btn-group">
                                <button type="submit" class="btn flat btn-info dataFormSubmit">
                                    保存
                                </button>
                            </div>
                            <div class="btn-group">
                                <button type="reset" class="btn flat btn-default dataFormReset">
                                    重置
                                </button>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        $("#dataForm").validate({
            rules: {
                name: {
                    required: true,
                },
                description: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "名称不能为空",
                },
                description: {
                    required: "简介不能为空",
                }
            },
        });
    </script>
@endsection

