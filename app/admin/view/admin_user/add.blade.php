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
                    <!-- 表单 -->
                    <form id="dataForm" class="form-horizontal dataForm"
                          @if(isset($data)) action="/admin/admin_user/{{$data->id}}"
                          @else action="/admin/admin_user"
                          @endif
                          method="post"
                          enctype="multipart/form-data">
                        <!-- 表单字段区域 -->

                        @if(isset($data))
                            <input type="hidden" name="_method" value="PUT">
                        @endif

                        <div class="box-body">

                            <div class="form-group">

                                <label for="avatar" class="col-sm-2 control-label">头像</label>
                                <div class="col-sm-10 col-md-4">
                                    <input id="avatar" name="avatar" placeholder="请上传头像"
                                           @if(isset($data->avatar))data-initial-preview="{{$data->avatar}}" @endif type="file"
                                    class="form-control field-image" >
                                </div>
                            </div>
                            <script>
                                $('#avatar').fileinput({
                                    language: 'zh',
                                    overwriteInitial: true,
                                    browseLabel: '浏览',
                                    initialPreviewAsData: true,
                                    dropZoneEnabled: false,
                                    showUpload: false,
                                    showRemove: false,
                                    allowedFileTypes: ['image'],
                                    maxFileSize: 10240,
                                });
                            </script>
                            <div class="form-group">

                                <label for="role" class="col-sm-2 control-label">用户角色</label>
                                <div class="col-sm-10 col-md-4">
                                    <select name="role" id="role" class="form-control field-select"
                                            data-placeholder="请选择用户角色">
                                        <option value="">请选择用户角色</option>
                                        @foreach($role as $item)

                                        <option value="{{$item->id}}" @if(isset($data) && $data['role'] == $item['id']) selected @endif>
                                            {{$item['name']}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <script>
                                $('#user_level_id').select2();
                            </script>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">用户名</label>
                                <div class="col-sm-10 col-md-4">
                                    <input id="username" name="username" value="{{$data['username'] ?? ''}}"
                                           placeholder="请输入用户名" type="text" class="form-control field-text">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-10 col-md-4">
                                    <input id="password" name="password"


                                           value=""

                                           placeholder="请输入密码" type="password" class="form-control field-password">
                                </div>
                            </div>


                        </div>
                        <!-- 表单底部 -->
                        <div class="box-footer">

                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-10 col-md-4">

                                <div class="btn-group">
                                    <button type="submit" class="btn flat btn-info dataFormSubmit">
                                        保存
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
        /** 表单验证 **/
        $('#dataForm').validate({
            rules: {
                'user_level_id': {
                    required: true,
                },
                'username': {
                    required: true,
                },
                'mobile': {
                    required: true,
                },
                'nickname': {
                    required: true,
                },

                'status': {
                    required: true,
                },

            },
            messages: {
                'user_level_id': {
                    required: "用户等级不能为空",
                },
                'username': {
                    required: "用户名不能为空",
                },
                'mobile': {
                    required: "手机号不能为空",
                },
                'nickname': {
                    required: "昵称不能为空",
                },
                'password': {
                    required: "密码不能为空",
                },
                'status': {
                    required: "是否启用不能为空",
                },

            }
        });
    </script>
@endsection