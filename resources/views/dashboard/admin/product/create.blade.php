@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="افزودن محصول" route="dashboard.admin.product.create" />
@endsection
@section('content')
<x-session-alerts></x-session-alerts>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

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

<div class="col-md-12">
    <x-card type="info">
        <x-card-header>محصول ها</x-card-header>

        <form style="padding:10px;" action="{{ route('dashboard.admin.product.create') }}" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
            @csrf

            <input
                type="text"
                style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                class="form-control"
                required
                name="title"
                value="{{ old('title') }}"
                placeholder="عنوان"
            >

            <textarea
                id="explain"
                style="padding:10px; margin: 10px 0px 16px 0px; height: 100px; border-radius: 7px; font-size: 16px;"
                class="form-control"
                required
                name="explain"
                placeholder="توضیح کوتاه"
            >{{ old('explain') }}</textarea>

            <input
                type="text"
                style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                class="form-control"
                required
                name="inventory"
                value="{{ old('inventory') }}"
                placeholder="تعداد موجودی در انبار"
            >

            <x-select-group name="brand" label="برند" required :model="$model ?? null">
                @foreach($brands as $brand)
                    <x-select-item :value="$brand->id" >
                        {{ $brand->name }}
                    </x-select-item>
                @endforeach
            </x-select-group>

            <x-select-group name="discountable" label="نمایش در طرح تخفیف" required>
                <option value="1">بله</option>
                <option value="0" >خیر</option>
            </x-select-group>

            <x-select-group name="category" label="دسته‌بندی" required :model="$model ?? null">
                @foreach($categories as $category)
                    <x-select-item :value="$category->id" >
                        @if(!empty($category->parent_id))
                            @for($i = 2; $i <= $category->level; $i++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c;
                        @endif
                        {{ $category->name }}
                    </x-select-item>
                @endforeach
            </x-select-group>

            <label for="color">ویژگی ها</label>
            <select
                name="color[]"
                multiple
                style="padding:10px; margin: 10px 0px 16px 0px;  border-radius: 7px; font-size: 16px;"
                class="form-control"
            >
                @php $oldColors = old('color', []); @endphp
                @foreach ($colors as $item)
                    <option value="{{ $item->id }}" {{ in_array($item->id, $oldColors) ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>

            <textarea
                id="content"
                style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"
                class="form-control"
                required
                name="content"
                placeholder="محتوا"
            >{{ old('content') }}</textarea>

            <div style="margin-top:40px;"></div>
            <h3 style="font-size:20px">قیمت گذاری</h3>
            <div class="row">
                <div class="col-md-6">
                    <input
                        type="text"
                        style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                        class="form-control"
                        required
                        name="price"
                        value="{{ old('price') }}"
                        placeholder="قیمت"
                    >
                </div>
                <div class="col-md-6">
                    <input
                        type="text"
                        style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                        class="form-control"
                        name="discount"
                        value="{{ old('discount') }}"
                        placeholder="قیمت با تخفیف"
                    >
                </div>
            </div>

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
                                        'name' => $tag['name'] ?? null,
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
                    function onRemove() { $(this).closest('tr').remove(); }
                    function updateListeners() { $('.btn-remove-tag').click(onRemove); }
                });

                document.addEventListener("DOMContentLoaded", function () {
                    let field = `@include('dashboard.admin.product.spec-item', ['specification' => null])`;
                    let idx = $("#specs tr").length + 1;
                    $('#add-spec').click(function () {
                        $("#specs").append(field.replace(/IDX/g, idx.toString()));
                        updateListeners();
                        idx ++;
                    });
                    function onRemove() { $(this).closest('tr').remove(); }
                    function updateListeners() { $('.btn-remove-spec').click(onRemove); }
                });
            </script>

            <div style="margin-top:40px;"></div>

            <input type="checkbox" id="lovely" name="lovely" value="yes" {{ old('lovely') == 'yes' ? 'checked' : '' }}>
            <label for="lovely">اضافه کردن در بهترین ها</label><br>

            <input type="checkbox" id="cheap" name="cheap" value="yes" {{ old('cheap') == 'yes' ? 'checked' : '' }}>
            <label for="cheap">اضافه کردن در شگفت انگیز</label><br>

            <div style="margin-top:40px;"></div>
            <h3 style="font-size:20px">تصاویر</h3>

            <label for="pic">تصویر اصلی محصول</label><br>
            <input
                type="file"
                style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;"
                class="dropzone"
                required
                name="pic"
                multiple
            >
            <label for="img[]">بقیه تصاویر</label><br>
            <input
                type="file"
                style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;"
                class="dropzone"
                required
                name="img[]"
                multiple
            >

            <script type="text/javascript">
                Dropzone.options.dropzone = {
                    maxFilesize: 12,
                    renameFile: function(file) {
                        var dt = new Date();
                        var time = dt.getTime();
                        return time + file.name;
                    },
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    addRemoveLinks: true,
                    timeout: 500000,
                    success: function(file, response) { console.log(response); },
                    error: function(file, response) { return 1; }
                };
            </script>

            <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;" class="btn btn-primary">ارسال</button>
            </x-card-footer>
        </form>
    </x-card>

    <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', { language: 'fa' });
        CKFinder.setupCKEditor(null, 'ckfinder/ckfinder.js');
    </script>
</div>
@endsection
