@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
<x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
<x-breadcrumb-item title="مدیریت فیلم ها" route="dashboard.admin.movies.manage" />
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
            <x-card-header>ویرایش فیلم ها</x-card-header>
        <form action="{{ route('dashboard.admin.movies.update', $post->id) }}" method="post" role="form" class="form-horizontal" style="padding:15px;" enctype="multipart/form-data">
            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="id" value="{{ $post->id }}" >
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  value="{{ $post->title }}"  name="title"  placeholder="عنوان">      
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->slug }}" name="slug"  placeholder="لینک کوتاه">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->duaration }}" name="duaration"  placeholder="مدت زمان">
            <x-select-group name="category_id" label="دسته‌بندی" required :model="$model ?? null">
                <option value="{{$post->category}}">{{$post->categorie->name}}</option>
                @foreach($categories as $category)
                    <x-select-item :value="$category->id">@if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}</x-select-item>
                @endforeach
            </x-select-group>
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->year }}" name="year"  placeholder="سال تولید">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->trailer }}" name="trailer"  placeholder="کد ای فریم">
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->description }}" name="description"  placeholder="توضیحات">{{ $post->description }}</textarea>
            <div style="margin-top:40px;"></div>
                   <div class="col-lg-12">
                        <div class="form-group">
                            <div style="margin-top:50px;"></div>
                            <h3>برچسب ها</h3>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        @isset($tags)
                                        @foreach($tags as $item)
                                           <tr>
                                               <td>{{ $item->name }}</td>
                                           </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>نام</th>
                                    </tr>
                                    </tfoot>
                            </table>
                        </div>
                    </div>
            <div class="form-group">
                <label>افزودن برچسب</label>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>نام برچسب</th>
                    </tr>
                    </thead>
                    <tbody id="tag">

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
            <img style="width:300px; height:300px;" src="{{ asset('pics/'.$post['image'].'/'.$post['image'] ) }}">
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone"  name="img">
            
            <label for="movie">فیلم</label><br>

            <video height="300" style="width:500px;" controls>
                <source src="{{ asset('pics/'.$post['link'].'/'.$post['link'] ) }}" type="video/mp4">
            </video>
            
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone" name="movie">
            
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
                <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
              	<script type="text/javascript">
                      CKEDITOR.replace('content', {
                      // Load the Farsi interface.
                          language: 'fa'
                      });
                      CKFinder.setupCKEditor(null, 'ckfinder/ckfinder.js');
                </script>
            {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
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
    @endsection