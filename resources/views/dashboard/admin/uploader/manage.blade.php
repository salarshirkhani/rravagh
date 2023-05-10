@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت فایل ها" route="dashboard.admin.uploader.manage" />
@endsection
@section('content')
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
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>مدیریت فایل ها</x-card-header>
                <x-card-body>
                    <form style="padding:10px;" action="{{ route('dashboard.admin.uploader.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
                        <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone" required name="file">
                         <script type="text/javascript">
                             Dropzone.options.dropzone =
                                 {
                                     maxFilesize: 12,
                                     renameFile: function(file) {
                                         var dt = new Date();
                                         var time = dt.getTime();
                                         return time+file.name;
                                     },
                                     acceptedFiles: ".jpeg,.jpg,.png,.gif",
                                     addRemoveLinks: true,
                                     timeout: 500000,
                                     success: function(file, response)
                                     {
                                         console.log(response);
                                     },
                                     error: function(file, response)
                                     {
                                         return 1;
                                     }
                                 };
                       </script>
                         {{ csrf_field() }}
                         <button type="submit" style="height: 42px;font-size: 20px;"  class="btn btn-success">ارسال فایل</button>
                         </form>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>آدرس</th>
                                <th>تصویر</th>
                                <th>حذف</th>                               
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>http://dubai.com/pics/{{ $item->link }}/{{ $item->link }}</td>
                                    <td><img src="{{ asset('pics/'.$item['link'].'/'.$item['link'] ) }}" style="width:120px;" ></td>
                                    <td>
                                    <a href="{{route('dashboard.admin.uploader.deleteupload',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>                 
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>آدرس</th>
                                    <th>تصویر</th>
                                    <th>حذف</th>      
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    لینک هارا کپی کرده و درمحل تعبیه شده در تکست باکس قرار دهید
                </x-card-footer>      
        </x-card>
    </div>
    @endsection