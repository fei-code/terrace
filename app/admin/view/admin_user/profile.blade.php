@extends('admin.view.public.base')
@section('content')
    @include('admin.view.public.content_header')
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{admin_avatar()}}" alt="头像">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">个人信息</a></li>
                    <li class=""><a href="#privacy" data-toggle="tab" aria-expanded="false">修改密码</a></li>
                    <li class=""><a href="#avatars" data-toggle="tab" aria-expanded="false">修改头像</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <form class="dataForm form-horizontal" id="dataForm1" action="{{admin_url('admin_user/profile_nickname')}}" method="post">
                            <input type="hidden" value="profile" name="update_type" placeholder="请勿修改">

                            <div class="form-group">
                                <label for="nickname" class="col-sm-2 control-label">昵称</label>
                                <div class="col-sm-10 col-md-4">
                                    <input class="form-control" value="{{$data['nickname'] ?? ''}}" name="nickname"
                                           id="nickname" maxlength="30"
                                           placeholder="请输入昵称">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="privacy">
                        <form class="dataForm form-horizontal" id="dataForm2" action="{{admin_url('admin_user/profile_password')}}" method="post">
                            <input type="hidden" value="password" name="update_type" placeholder="请勿修改">
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">当前密码</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="password" autocomplete='password' class="form-control" name="old_password" id="password"
                                           placeholder="请输入当前密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="new_password" class="col-sm-2 control-label">新密码</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="password" class="form-control" autocomplete='off' name="password" id="assword"
                                           placeholder="请输入新密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="renew_password" class="col-sm-2 control-label">确认新密码</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="password" class="form-control" autocomplete='off' name="password_confirm" id="renew_password"
                                           placeholder="再次输入新密码">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="avatars">
                        <form class="dataForm form-horizontal" id="dataForm3" action="{{admin_url('admin_user/profile_avatar')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="avatar" name="update_type" placeholder="请勿淘气修改">
                            <div class="form-group">
                                <label for="avatar" class="col-sm-2 control-label">头像</label>
                                <div class="col-sm-10 col-md-4">
                                    <input id="avatar" name="avatar" placeholder="请上传头像"
                                           @if(isset($data))
                                           data-initial-preview="{{$data['avatar'] ??''}}"
                                           @endif

                                           type="file"
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
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $("#dataForm1").validate({
        rules: {
            nickname: {
                required: true,
                minlength: 2,
                maxlength: 10
            }
        },
        messages: {
            nickname: {
                required: "请输入昵称",
                minlength: "昵称长度不能小于2",
                maxlength: "昵称长度不能大于10"
            }
        }
    });

    $("#dataForm2").validate({
        rules: {
            password: {
                required: true,
                minlength: 6
            },
            new_password: {
                required: true,
                minlength: 6
            },
            renew_password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            password: {
                required: "请输入当前密码",
                minlength: "当前密码长度不能小于6"
            },
            new_password: {
                required: "请输入新密码",
                minlength: "新密码长度不能小于6"
            },
            renew_password: {
                required: "请输入确认新密码",
                minlength: "确认新密码长度不能小于6"
            }
        }
    });

    $("#dataForm3").validate({
        rules: {
            avatar: {
                required: true
            }
        },
        messages: {
            avatar: {
                required: "请选择文件"
            }
        }
    });
</script>
@endsection
