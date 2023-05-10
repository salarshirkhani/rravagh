@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('title', __('داشبورد'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="لیست دسته‌بندی‌ها" route="dashboard.admin.categories.index" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <x-card>
            <x-card-body>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>لینک</th>
                        <th>مدل</th>
                        <th style="width: 15vw">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>@if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>@if($category->type=='movie') فیلم  @endif @if($category->type=='product') محصول @else وبلاگ @endif</td>
                            <td>
                                <a href="{{ route('dashboard.admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                 <a href="#" class="delete_post" ><i class="fa fa-fw fa-eraser"  data-toggle="modal" data-target="#modal-success{{ $category->id }}"></i></a>                                    </td>
                            </td>

                        </tr>
                        <!-- SHOW SUCCESS modal -->
                                <div class="modal fade show" id="modal-success{{ $category->id }}" aria-modal="true" role="dialog">
                                    <div class="modal-dialog modal-danger">
                                      <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                          <h4 class="modal-title">{{ $category->name }}</h4>
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
                                               <input type="hidden" name="id" value="{{ $category->id }}" >
                                              <a href="{{route('dashboard.admin.categories.deletecat',['id'=>$category->id])}}" class="btn btn-outline-light">بله </a>
                                           </form>
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                    @endforeach
                    </tbody>
                </table>
            </x-card-body>
            <x-card-footer>
                <a href="{{route('dashboard.admin.categories.create')}}" class="btn btn-success">ثبت دسته بندی جدید</a>
            </x-card-footer>    
        </x-card>
    </div>
@endsection