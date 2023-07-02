@extends('layouts.frontt')
@section('content')
<style>
    .blogs a {
    bottom: 0px;
    }
</style>
<div class="container">
    <h2 class="bloghead">وبلاگ</h2>
    @foreach ($posts as $item)
    <div class="newblogs" style="margin:15px 0px;">
        
        <div class="newblogimg">
            <a href="{{route('post',['id'=>$item->id])}}">
				<img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->title}}">
            </a>
        </div>
        <div class="newblogdets">
            <a href="{{route('post',['id'=>$item->id])}}"><h4>{!! \Illuminate\Support\Str::limit($item->title, 55, ' ...') !!}</h4></a>
            <p>{!! \Illuminate\Support\Str::limit($item->explain, 95, ' ...') !!}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection