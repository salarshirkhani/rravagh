@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="ویرایش محصول" route="dashboard.admin.product.updateproduct" />
@endsection
@section('content')
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="col-md-12">
                                        <p class="alert alert-danger">{{ $error }}</p>
                                    </div>
                                @endforeach
                            @endif  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>ویرایش محصول ها</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.product.updateproduct', $post->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="id" value="{{ $post->id }}" >
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  value="{{ $post->name }}"  name="title"  placeholder="عنوان">            
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->explain }}" name="explain"  placeholder="توضیح کوتاه">
          <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required name="inventory" value="{{ $post->inventory }}"   placeholder="تعداد موجودی در انبار">
            <x-select-group name="brand" label="برند" required :model="$model ?? null">
                <option value="{{$post->brands->id}}">{{$post->brands->name}}</option>
                 @foreach($brands as $brand)
                    <x-select-item :value="$brand->id" >
                        {{ $brand->name }}
                    </x-select-item>
                @endforeach
            </x-select-group>
            <x-select-group name="discountable" label="نمایش در طرح تخفیف" required >
                <option value="1" selected>بله</option>
                <option value="0">خیر</option>
            </x-select-group>
            <x-select-group name="category_id" label="دسته‌بندی" required :model="$model ?? null">
                <option value="{{$post->category}}">{{$post->categorie->name}}</option>
                @foreach($categories as $category)
                    <x-select-item :value="$category->id">@if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}</x-select-item>
                @endforeach
            </x-select-group>
            <label for="color">ویژگی ها</label>
            <select name="color[]" multiple style="padding:10px; margin: 10px 0px 16px 0px;  border-radius: 7px; font-size: 16px;"class="form-control">
                @foreach ($colors as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <div style="margin-top:40px;"></div>
            <h3 style="font-size:20px">قیمت گذاری</h3>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required value="{{ $post->price }}" name="price"   placeholder="قیمت">
                </div>
                <div class="col-md-6">
                    <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="discount" value="{{ $post->discount }}" placeholder="قیمت با تخفیف">
                </div> 
            </div>
            <div style="margin-top:40px;"></div>
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" value="" name="content"  placeholder="توضیحات">{{ $post->content }}</textarea>
            {{ csrf_field() }}
            <div style="margin-top:40px;"></div>
                   <div class="col-lg-12">
                        <div class="form-group">
                            <div style="margin-top:50px;"></div>
                            <h3>برچسب ها</h3>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>نام</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @isset($tags)
                                 @foreach($tags as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{route('dashboard.admin.deletetag',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>
                                        </td>
                                    </tr>
                                 @endforeach
                                 @endisset
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>نام</th>
                                        <th>عملیات</th>
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
                    <td colspan="3">
                        <button id="add-tag" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                    </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div style="margin-top:40px;"></div>
                <div class="col-lg-12">
                        <div class="form-group">
                            <div style="margin-top:50px;"></div>
                            <h3>مشخصات</h3>
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>مقدار</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                 @isset($specification)
                                 @foreach($specification as $item)
                                    <tr>
                                        <td>{{ $item->key }}</td>
                                        <td>{{ $item->value }}</td>
                                        <td>
                                            <a href="{{route('dashboard.admin.deletespecification',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>
                                        </td>
                                    </tr>
                                 @endforeach
                                 @endisset
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>مقدار</th>
                                        <th>عملیات</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                </div>
            <div style="margin-top:40px;"></div>
            <div class="form-group">
                <label>جدول مشخصات</label>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>مقدار</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="specs">
                    @if(old('specifications'))
                        @foreach(old('specifications') as $idx => $specification)
                            @if(!empty($specification['key']) || !empty($specification['value']))
                                @include('dashboard.admin.product.spec-item', [
                                    'idx' => $idx,
                                    'key' => $specification['key'],
                                    'value' => $specification['value'],
                                ])
                            @endif
                        @endforeach
                    @elseif(!empty($model))
                        @foreach($model->specifications as $specification)
                            @include('dashboard.admin.product.spec-item', ['specification' => $specification])
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                    <td colspan="3">
                        <button id="add-spec" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                    </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let field = `@include('dashboard.admin.product.tag-item', ['tag' => null])`;
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

                document.addEventListener("DOMContentLoaded", function () {
                    let field = `@include('dashboard.admin.product.spec-item', ['specification' => null])`;
                    let idx = $("#specs tr").length + 1;
                    $('#add-spec').click(function () {
                        $("#specs").append(field.replace(/IDX/g, idx.toString()));
                        updateListeners();
                        idx ++;
                    });
                    function onRemove() {
                        $(this).closest('tr').remove();
                    }
                    function updateListeners() {
                        $('.btn-remove-spec').click(onRemove);
                    }
                });
            </script>
            <style>
              .gallery{display:flex;flex-wrap:wrap;gap:12px}
              .img-card{position:relative;width:220px;height:220px;overflow:hidden;border-radius:12px}
              .img-card img{width:100%;height:100%;object-fit:cover;display:block}
              .delete-btn{
                position:absolute;top:8px;right:8px;
                padding:6px 10px;border-radius:10px;
                background:#ef4444;color:#fff;text-decoration:none;font-size:14px;line-height:1;
                opacity:0;transform:translateY(-4px);transition:opacity .2s ease,transform .2s ease
              }
              .img-card:hover .delete-btn,
              .img-card:focus-within .delete-btn{opacity:1;transform:translateY(0)}
              .delete-btn:focus{outline:2px solid #fff;outline-offset:2px}
            </style>
            <div style="margin-top:40px;"></div>
            <input type="checkbox" id="lovely" name="lovely" value="yes">
            <label for="lovely">اضافه کردن در بهترین ها</label><br>
            <input type="checkbox" id="cheap" name="cheap" value="yes">
            <label for="cheap">اضافه کردن در شگفت انگیز</label><br>
            <div style="margin-top:40px;"></div>
            <h3 style="font-size:20px">تصاویر</h3>   
            <label for="pic">تصویر اصلی محصول</label><br>
            <img style="width:300px; height:300px;" src="{{ asset('pics/'.$post['pic'].'/'.$post['pic'] ) }}">
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone"  name="pic" multiple>
            <label for="img[]">بقیه تصاویر</label><br>
            <div class="gallery">
              @foreach ($images as $pic)
                <div class="img-card">
                  {{-- بر اساس نمونه‌ی خودت: --}}
                  <img src="{{ asset('pics/'.$pic['link'].'/'.$pic['link']) }}" alt="image">
            
                  <a class="delete-btn"
                     href="{{ url('dashboard/admin/deleteupload/'.$pic['id']) }}"
                     title="حذف این عکس"
                     onclick="return confirm('این عکس حذف شود؟');">
                     🗑️ حذف
                  </a>
                </div>
              @endforeach
            </div>
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone"  name="img[]" multiple>
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
                        renameFile: function(pic) {
                            var dt = new Date();
                            var time = dt.getTime();
                            return time+pic.name;
                        },
                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                        addRemoveLinks: true,
                        timeout: 500000,
                        success: function(pic, response)
                        {
                            console.log(response);
                        },
                        error: function(pic, response)
                        {
                            return 1;
                        }
                    };
            </script>
            <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
            </x-card-footer>
        </form>
    </x-card>
    </div>
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
                        let field = `@include('dashboard.admin.product.tag-item', ['tag' => null])`;
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