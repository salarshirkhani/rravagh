@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت کاربر ها" route="dashboard.admin.users.index" />
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
            <x-card-header>مدیریت کاربر ها</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>نام و نام خانوادگی</th>
                                <th>شماره موبایل</th>
                                <th>ایمیل</th>
                                <th>وضعیت کاربری</th>
                                <th>تاریخ تولد</th>
                                <th>نمایش</th>
                                <th>حذف</th>                               
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($user as $item)
                                <tr>
                                    <td><img src="{{ asset('pics/'.$item['profile'].'/'.$item['profile'] ) }}" alt="" style="width:100px; height:100px; border-radius: 70px;"></td>
                                    <td>{{ $item->first_name }} {{$item->last_name}}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                       @if($item->type=='buyer')
                                            خریدار
                                       @endif
                                       @if($item->type=='teacher')
                                        نویسنده
                                       @endif
                                       @if($item->type=='seller')
                                         خریدار عمده
                                       @endif
                                    </td>
                                    <td>{{ Facades\Verta::instance($item->birthdate)->format('Y/n/j')}}</td>  
                                    <td>
                                        <a href="{{route('dashboard.admin.users.show',['id'=>$item->id])}}" class="btn btn-warning">نمایش</a>
                                    </td>
                                    <td>
                                        <a href="{{route('dashboard.admin.users.deleteuser',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>                 
                                    </td>
                                    <td>
                                        <a href="{{route('dashboard.admin.users.edit',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>تصویر</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>شماره موبایل</th>
                                    <th>ایمیل</th>
                                    <th>وضعیت کاربری</th>
                                    <th>تاریخ تولد</th>
                                    <th>نمایش</th>
                                    <th>حذف</th>                               
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    <a href="{{route('dashboard.admin.users.create')}}" class="btn btn-success">ثبت کاربر جدید</a>
                </x-card-footer>      
        </x-card>
    </div>

@endsection