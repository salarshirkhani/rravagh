@extends('layouts.frontt')
@section('content')
<div class="container">
    <h2 class="bloghead"> مطالب برچسب {{$tag}}</h2>
    @foreach ($posts as $item)   
    <div class="blogs">
        <div class="row">
			<div class="blogsingle">
				<div class="col-md-3 col-xs-4">
					<div class="blogimg">
						<img src="{{ asset('pics/'.$item->post->pic.'/'.$item->post->pic ) }}" alt="{{$item->post->title}}">
					</div>
				</div>
				<div class="col-md-9 col-xs-8">
					<div class="blogdets">
						<h3>{{$item->post->title}}</h3>
						{!! \Illuminate\Support\Str::limit($item->post->explain, 325, ' ...') !!}
					</div>
					<a href="{{route('post',['id'=>$item->post->id])}}">ادامه مطلب</a>
				</div>
			</div>
        </div>
    </div>
    @endforeach
</div>
@endsection