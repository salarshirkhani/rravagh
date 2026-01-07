@extends('layouts.frontt')
@section('content')
<section class="content">
    <div class="container">
     <div class="phoneset">
      <div class="carouseltitle">
          <h2>{{$category->name}}</h2>
          <p>{!!$category->description!!}</p>=
      </div>  
      <div class="firstcarousel" >
       @foreach ($movies as $item)
        <div class="carousel-cell carousels">
          <div class="carouseldn">
            <a href="{{route('media.movie',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}"></a>
            <div class="productdesc">
              <a href="{{route('media.movie',['id'=>$item->id])}}">{{$item->title}}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->post->description, 85, ' ...') !!}</p>
              <a href="{{route('media.movie',['id'=>$item->id])}}" class="viewprd">مشاهده فیلم</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    <div class="firstset">
        <div class="carouseltitle">
          <h2>{{$category->name}}</h2>
          <p>{!!$category->description!!}</p>
        </div>
        <div class="row">
            @foreach ($movies as $item)
            <div class="col-md-3">
                <div class="carousel-cell carousels">
                    <div class="carouseldn">
                        <a href="{{route('media.movie',['id'=>$item->id])}}">
                            <img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}">
                        </a>
                      <div class="productdesc">
                        <a href="{{route('media.movie',['id'=>$item->id])}}">{{$item->title}}</a>
                        <p>{!! \Illuminate\Support\Str::limit($item->post->description, 85, ' ...') !!}</p>
                        <a href="{{route('media.movie',['id'=>$item->id])}}" class="viewprd">مشاهده فیلم</a>
                      </div>
                    </div>
                  </div>
            </div>
            @endforeach

        </div>
      </div>
    </div>
  </section>
@endsection

