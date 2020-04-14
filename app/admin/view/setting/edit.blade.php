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

                <form id="dataForm" class="form-horizontal dataForm"  action="/admin/setting/{{$data->id}}" method="post"
                enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                <div class="box-body">
                    {!!html_form('字段名称','name')->value($data->name)->text()  !!}
                    {!!html_form('字段描述','name_desc')->value($data->name_desc)->text()  !!}
                    <div class="form-group">
                        <label for="setting_type" class="col-sm-2 control-label">设置类型</label>
                        <div class="col-sm-10 col-md-4">
                            <select name="setting_type" id="setting_type" class="form-control field-select" data-placeholder="请选择设置类型">
                                @foreach($settingSelect as $key=>$value)

                                    <option value="{{$key}}"  @if($key == $data->setting_type) selected @endif>{{$value}} </option>
                                    @endforeach

                            </select>
                        </div>
                        <script>
                            $('#setting_type').select2();
                        </script>
                    </div>

                    {!!html_form('字段选择值','value_description')->value($data->value_description)->textarea()  !!}







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

