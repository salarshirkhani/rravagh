@extends('layouts.front')
@section('content')
<div class="container">
    <h3 class="blogtitle">نتایح یافته شده</h3>
    @foreach ($posts as $item)   
    <div class="blogs">
        <div class="row">
			<div class="blogsingle">
				<div class="col-md-3 col-xs-4">
					<div class="blogimg">
						<img src="{{asset('img/554.png')}}" alt="{{$item->title}}">
					</div>
				</div>
				<div class="col-md-9 col-xs-8">
					<div class="blogdets">
						<h3>{{$item->title}}</h3>
						{!! \Illuminate\Support\Str::limit($item->explain, 325, ' ...') !!}
					</div>
					<a href="{{route('post',['id'=>$item->id])}}">ادامه مطلب</a>
				</div>
			</div>
        </div>
    </div>
    @endforeach
</div>
@endsection