@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="ویرایش نظر" route="dashboard.admin.comment.updatecomment" />
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
            <x-card-header>ویرایش نظر ها</x-card-header>
        <form action="{{ route('dashboard.admin.comment.updatecomment', $post->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data" style="padding:10px;">
            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="id" value="{{ $post->id }}" >
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" value="{{ $post->name }}" name="name"  placeholder="نام نویسنده">
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" row='8' value="{{ $post->description }}" name="content"  placeholder="توضیحات">{{ $post->description }}</textarea>
            {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-success">تایید</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection