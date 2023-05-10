@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت ارسالی ها" route="dashboard.admin.promotion.manage" />
@endsection
@section('content')
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>ارسالی های پروموشن</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              	<th>#</th>
                                <th>نام فرد</th>
                                <th>شماره تماس</th>
                                <th>فایل ارسالی</th>
                                <th>حذف</th>                               
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{route('dashboard.admin.users.show',['id'=>$item->user_id])}}">{{ $item->name }}</a></td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>
                                    @isset($item->file)
                                   	 <p><a class="btn btn-warning" href="https://ketabjang.com/pics/{{$item->file}}/{{$item->file}}" target="_blank">برای مشاهده کلیک کنید</a></p>
                                    @endisset             
                                    </td>
                                    <td>
                                    <a href="{{route('dashboard.admin.promotion.deletepro',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-eraser"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                  <th>#</th>
                                  <th>نام فرد</th>
                                  <th>شماره تماس</th>
                                  <th>فایل ارسالی</th>
                                  <th>حذف</th>                               
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    
                </x-card-footer>      
        </x-card>
    </div>
    @endsection