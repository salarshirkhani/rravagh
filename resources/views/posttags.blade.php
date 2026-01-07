@extends('layouts.frontt')
@section('content')
<style>
    .blogs a {
    bottom: 0px;
    }
</style>
<div class="container">
    <h2 class="bloghead"> مطالب برچسب {{$tag}}</h2>
    @foreach ($posts as $item)
    <div class="newblogs" style="margin:15px 0px;">
        
        <div class="newblogimg">
            <a href="{{route('post',['id'=>$item->post->id])}}">
				<img src="{{ asset('pics/'.$item->post->pic.'/'.$item->post->pic ) }}" alt="{{$item->post->title}}">
            </a>
        </div>
        <div class="newblogdets">
            <a href="{{route('post',['id'=>$item->post->id])}}"><h4>{!! \Illuminate\Support\Str::limit($item->post->title, 55, ' ...') !!}</h4></a>
            <p>{!! \Illuminate\Support\Str::limit($item->post->explain, 95, ' ...') !!}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection