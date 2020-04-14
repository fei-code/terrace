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

                <form id="dataForm" class="form-horizontal dataForm"  action="/admin/setting/add" method="post"
                enctype="multipart/form-data">

                <div class="box-body">
                    @forelse($data as $item)
                        @switch($item->setting_type)
                            @case(1)
                            {!! html_form($item->name_desc,$item->name)->value($item->value)->text()  !!}
                        @break
                            @default

                            @endswitch

{{--                        {!!html_form('字段描述','name_desc')->text()  !!}--}}


{{--                        {!!html_form('字段选择值','value_description')->textarea()  !!}--}}
                        @empty
                        暂无设置
                        @endforelse










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

