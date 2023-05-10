@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت  سفارش ها" route="dashboard.admin.orders.manage" />
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
            <x-card-header>سفارش  ها</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>محصول</th>
                                <th>وضعیت</th>
                                <th>تعداد</th>
                                <th>قیمت</th>
                                <th>تاریخ</th>
                                <th>آدرس</th>
                                <th>کد پستی</th>
                                <th>شماره تماس</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td><a href="{{route('dashboard.admin.users.show',['id'=>$item->user_id])}}">{{ $item->person->first_name }} {{ $item->person->last_name }}</a></td>
                                    <td>{{ $item->for->name }}</td>
                                    <td>@if($item->status=='paid') <p style="color:green; font-weight:800;">پرداخت موفق</p> @else <p style="color:red; font-weight:800;">پرداخت نشده</p> @endif</td>
                                    <td>{{ $item->number }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ Facades\Verta::instance($item->created_at)->format('Y/n/j')}}</td>  
                                    <td>{{ $item->transaction->address }}</td>
                                    <td>{{ $item->transaction->postcode }}</td>
                                    <td>{{ $item->transaction->phone }}</td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>کاربر</th>
                                    <th>محصول</th>
                                    <th>وضعیت</th>
                                    <th>تعداد</th>
                                    <th>قیمت</th>
                                    <th>تاریخ</th>
                                    <th>آدرس</th>
                                    <th>کد پستی</th>
                                    <th>شماره تماس</th>
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