@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت تخفیف ها" route="dashboard.admin.discount.manage" />
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
            <x-card-header>مدیریت تخفیف ها</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>کد</th>
                                <th>نوع تخفیف</th>
                                <th>درصد تخفیف</th>
                                <th>تاریخ پایان</th>
                                <th>حذف</th>                               
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <th>
                                    @if($item->discount_type=='subscribe')     
                                        روی اشتراک
                                    @else
                                    
                                        روی محصول
                                        
                                    @endif
                                    </th>
                                    <td>{{ $item->discount }} %</td>
                                    <td>{{ Facades\Verta::instance($item->finish_date)->format('Y/n/j')}}</td>  
                                    <td>
                                        <a href="#" class="delete_post" ><i class="fa fa-fw fa-eraser"  data-toggle="modal" data-target="#modal-success{{ $item->id }}"></i></a>                                    </td>
                                    </td>
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
                                               <input type="hidden" name="id" value="{{ $item->id }}" >
                                              <a href="{{route('dashboard.admin.discount.deletediscount',['id'=>$item->id])}}" class="btn btn-outline-light">بله </a>
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
                                    <th>کد</th>
                                    <th>نوع تخفیف</th>
                                    <th>درصد تخفیف</th>
                                    <th>تاریخ پایان</th>
                                    <th>حذف</th>                              
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    <a href="{{route('dashboard.admin.discount.create')}}" class="btn btn-success">ثبت تخفیف جدید</a>
                </x-card-footer>      
        </x-card>
    </div>
    @endsection