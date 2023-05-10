@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="افزودن فیلم" route="dashboard.admin.movies.create" />
@endsection
@section('content')
@if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="col-md-12">
                <p class="alert alert-danger">{{ $error }}</p>
            </div>
        @endforeach
    @endif
    </div>
@endif

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>افزودن فیلم</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.movies.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title"  placeholder="عنوان">            
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required name="slug"  placeholder="لینک مطلب">
            <input type="text" row="8" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required name="duaration"  placeholder="مدت زمان مثلا 12:18 ">
            <x-select-group name="category" label="دسته‌بندی" required :model="$model ?? null">
                @foreach($categories as $category)
                    <x-select-item :value="$category->id">@if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}</x-select-item>
                @endforeach
            </x-select-group>
            <input type="text" row="8" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required name="year"  placeholder="سال تولید مثلا 1400">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 90px; border-radius: 7px; font-size: 16px;"class="form-control"  name="trailer"  placeholder="کد ای فریم از آپارات یا سایت های مشابه">
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" required name="description"  placeholder="محتوا"></textarea>
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
                                @include('dashboard.admin.movies.tag-item', [
                                    'idx' => $idx,
                                    'name' => $tag['name'],
                                ])
                            @endif
                        @endforeach
                    @elseif(!empty($model))
                        @foreach($model->tags as $tag)
                            @include('dashboard.admin.movies.tag-item', ['tag' => $tag])
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
            
            <label for="movie">فیلم</label><br>
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone"  name="movie">
            
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


                    Dropzone.options.dropzone =
                    {
                        maxFilesize: 12,
                        renameFile: function(movie) {
                            var dt = new Date();
                            var time = dt.getTime();
                            return time+movie.name;
                        },
                        acceptedFiles: ".mp4,.mpeg,.png,.gif",
                        addRemoveLinks: true,
                        timeout: 500000,
                        success: function(movie, response)
                        {
                            console.log(response);
                        },
                        error: function(movie, response)
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
                        let field = `@include('dashboard.admin.movies.tag-item', ['tag' => null])`;
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