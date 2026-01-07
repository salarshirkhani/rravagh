@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت لندینگ ها" route="dashboard.admin.page.manage" />
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
            <x-card-header>مدیریت لندینگ ها</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>توضیح کوتاه</th>
                                <th>لینک</th>
                                <th>حذف</th>                               
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->explain }}</td>
                                    <td>https://rravagh.com/page/{{ $item->id }}</td>
                                    <td>
                                        <a href="#" class="delete_post" ><i class="fa fa-fw fa-eraser"  data-toggle="modal" data-target="#modal-success{{ $item->id }}"></i></a>
                                    </td>
                                    <td>
                                    <a href="{{route('dashboard.admin.page.updatepage',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
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
                                              <a href="{{route('dashboard.admin.page.deletepage',['id'=>$item->id])}}" class="btn btn-outline-light">بله </a>
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
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>توضیح کوتاه</th>
                                    <th>لینک</th>
                                    <th>حذف</th>                               
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    <a href="{{route('dashboard.admin.page.create')}}" class="btn btn-success">ثبت لندینگ جدید</a>
                </x-card-footer>      
        </x-card>
    </div>
    @endsection