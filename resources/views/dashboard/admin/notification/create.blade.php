@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="افزودن اعلان" route="dashboard.admin.notification.create" />
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
            <x-card-header>اعلان</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.notification.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title"  placeholder="عنوان">            
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 90px; border-radius: 7px; font-size: 16px;"class="form-control"  name="explain"  placeholder="توضیح کوتاه">
            <x-select-group name="role" label="وضعیت کاربر" required :model="$model ?? null">
		        <x-select-item value="all">همه کاربران</x-select-item>
                <x-select-item value="buyer">کاربر عادی</x-select-item>
                <x-select-item value="seller">خریدار عمده</x-select-item>
                <x-select-item value="teacher">مدرس</x-select-item>
            </x-select-group>
            <select name="status" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control">
                <option value="publish">فعال<option>
                <option value="pending">غیرفعال<option>
            </select>   
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control"  name="content"  placeholder="محتوا"></textarea>
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
    </div>
    @endsection