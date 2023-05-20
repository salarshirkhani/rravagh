@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="ویرایش پست" route="dashboard.admin.news.updatepost" />
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
            <x-card-header>ویرایش پست ها</x-card-header>
        <form action="{{ route('dashboard.admin.news.updatepost', $post->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="id" value="{{ $post->id }}" >
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  value="{{ $post->title }}"  name="title"  placeholder="عنوان">      
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->slug }}" name="slug"  placeholder="لینک کوتاه">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->explain }}" name="explain"  placeholder="توضیح کوتاه">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->writer }}" name="writer"  placeholder="نام نویسنده">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->iframe }}" name="iframe"  placeholder="کد ای فریم">
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->content }}" name="content"  placeholder="توضیحات">{{ $post->content }}</textarea>
            <div style="margin-top:40px;"></div>
                   <div class="col-lg-12">
                        <div class="form-group">
                            <div style="margin-top:50px;"></div>
                            <h3>برچسب ها</h3>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>پاک کردن</th>
                                </tr>
                                </thead>
                                    <tbody>
                                 @foreach($tags as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td><a href="#" class="delete_post" ><i class="fa fa-fw fa-eraser"  data-toggle="modal" data-target="#modal-success{{ $item->id }}"></i></a></td>
                                    </tr>
                                <!-- SHOW SUCCESS modal -->
                                <div class="modal fade show" id="modal-success{{ $item->id }}" aria-modal="true" role="dialog">
                                    <div class="modal-dialog modal-danger">
                                      <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                          <h4 class="modal-title">{{ $item->name }}</h4>
                                          <button type="button" class="close uncheckd" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true">×</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            آیا می خواهید این  مورد حذف کنید ؟
                    
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-outline-light uncheckd" data-dismiss="modal">خیر</button>
                                           <form  action="#" method="post">
                                               <input type="hidden" name="ids" value="{{ $item->id }}" >
                                              <a href="{{route('dashboard.admin.news.ndeletetags',['ids'=>$item->id])}}" class="btn btn-outline-light">بله </a>
                                           </form>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                 @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>نام</th>
                                        <th>پاک کردن</th>
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
            <img style="width:300px; height:300px;" src="{{ asset('pics/'.$post['pic'].'/'.$post['pic'] ) }}">
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone"  name="img">
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
    @endsection