@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="افزودن اخبار" route="dashboard.admin.news.create" />
@endsection
@section('content')
@if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>بلاگ</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.news.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title"  placeholder="عنوان">            
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required name="slug"  placeholder="لینک مطلب">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 90px; border-radius: 7px; font-size: 16px;"class="form-control" required name="explain"  placeholder="توضیح کوتاه">
            <input type="text" row="8" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required name="writer"  placeholder="نام نویسنده">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 90px; border-radius: 7px; font-size: 16px;"class="form-control"  name="iframe"  placeholder="کد ای فریم">
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" required name="content"  placeholder="محتوا"></textarea>
            <div style="margin-top:40px;"></div>
            <div class="form-group">
                <label>برچسب ها</label>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>نام برچسب</th>
                    </tr>
                    </thead>
                    <tbody id="tag">
                    @if(old('tags'))
                        @foreach(old('tags') as $idx => $tag)
                            @if(!empty($tag['key']) || !empty($tag['value']))
                                @include('dashboard.admin.product.tag-item', [
                                    'idx' => $idx,
                                    'name' => $tag['name'],
                                ])
                            @endif
                        @endforeach
                    @elseif(!empty($model))
                        @foreach($model->tags as $tag)
                            @include('dashboard.admin.product.tag-item', ['tag' => $tag])
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                    <td colspan="3">
                        <button id="add-tag" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                    </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <label for="img">تصویر</label><br>
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone" required name="img">
            <script type="text/javascript">
                Dropzone.options.dropzone =
                    {
                        maxFilesize: 12,
                        renameFile: function(img) {
                            var dt = new Date();
                            var time = dt.getTime();
                            return time+img.name;
                        },
                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                        addRemoveLinks: true,
                        timeout: 500000,
                        success: function(img, response)
                        {
                            console.log(response);
                        },
                        error: function(img, response)
                        {
                            return 1;
                        }
                    };
                </script>
            {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
        // Load the Farsi interface.
            language: 'fa'
        });
        CKFinder.setupCKEditor(null, 'ckfinder/ckfinder.js');
    </script>
    <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        let field = `@include('dashboard.admin.news.tag-item', ['tag' => null])`;
                        let idx = $("#tag tr").length + 1;
                        $('#add-tag').click(function () {
                            $("#tag").append(field.replace(/IDX/g, idx.toString()));
                            updateListeners();
                            idx ++;
                        });
                        function onRemove() {
                            $(this).closest('tr').remove();
                        }
                        function updateListeners() {
                            $('.btn-remove-tag').click(onRemove);
                        }
                    });

    </script>
    </div>
    @endsection