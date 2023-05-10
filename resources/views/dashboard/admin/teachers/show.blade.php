@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدرسین" route="dashboard.admin.teachers.index" />
    <x-breadcrumb-item title="صفحه کاربری" route="dashboard.admin.teachers.show" />
@endsection
@section('content')
@if(Session::has('info'))
<div class="row">
    <div class="col-md-12">
        <p class="alert alert-success">{{ Session::get('info') }}</p>
    </div>
</div>
@endif
<?php $ord=0 ?>
@include('dashboard.admin.teachers.changerole')
    <div class="container">
            <div class="row">
              <div class="col-md-3">
      
                  <!-- Profile Image -->
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('pics/'.$user['profile'].'/'.$user['profile'] ) }}" alt="{{ $user->first_name }}">
                      </div>
      
                      <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>
      
                      <p class="text-muted text-center">{{ $user->type }}</p>
      
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>شماره موبایل</b> <a class="float-right">{{ $user->mobile }}</a>
                        </li>
                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal-lg">تغیر وضعیت کاربری</button>

                      </ul>
                    </div>
                    <!-- /.card-body -->
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="row">
                      <div class="col-md-12">
                        <x-card type="info" >
                          <x-card-header> اختصاص برند به   {{$user->first_name}} {{$user->last_name}}</x-card-header>
                            <form style="padding:15px;" action="{{ route('dashboard.admin.teachers.brand') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
                              <x-select-group name="brand" label="برند" required :model="$model ?? null">
                                @foreach ($brands as $item)
                                  <x-select-item value="{{$item->id}}">{{$item->name}}</x-select-item>
                                @endforeach
                              </x-select-group> 
                              <input type="hidden" name="id" value="{{$user->id}}">
                              <input type="hidden" name="type" value="teacher">
                              {{ csrf_field() }}
                            <x-card-footer>
                                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">افزودن</button>
                            </x-card-footer>
                              </form>
                        </x-card>  
                      </div>
                      <div class="col-md-12">
                        <x-card type="info" >
                          <x-card-header> برند های  {{$user->first_name}} {{$user->last_name}}</x-card-header>
                          <x-card-body>
                            <div class="box-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>نام برند</th>
                                          <th>پاک کردن</th>
                                      </tr>
                                      </thead>
                                          <tbody>
                                       @foreach($academy as $item)
                                          <tr>
                                              <td>{{ $item->brands->name }}</td>
                                              <td>
                                                <a href="{{route('dashboard.admin.teachers.deletebrand',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>                 
                                              </td>
                                          </tr>
                                       @endforeach
                                          </tbody>
                                          <tfoot>
                                          <tr>
                                            <th>نام برند</th>
                                            <th>پاک کردن</th>
                                          </tr>
                                  </tfoot>
                                </table>
                            </div>    
                          </x-card-body>
                          <x-card-footer>
                          </x-card-footer>
                        </x-card>  
                      </div>
                  </div>
              </div>
            </div>
    </div>
@endsection
