@extends('layouts.frontt')
@section('content')
<section class="content">
    <div class="container">
      <div class="main-carousel" data-flickity='{ "wrapAround": false, "freScroll":true, "autoPlay": 3000, "pauseAutoPlayOnHover": true  }'>
        @foreach ($banners->where('place','slider') as $item)
        <div class="carousel-cell">
          <a href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" style="width:100%;" alt="{{$item->title}}"></a>
        </div>
        @endforeach
      </div>
    <div class="firstset">
        <div class="carouseltitle">
          <h2>تمامی فیلم ها</h2>
          <p>آخرین فیلم های رواق را در اینجا مشاهده کنید.</p>
        </div>
        <div class="row">
            @foreach ($movies as $item)
            <div class="col-md-3">
                <div class="carousel-cell carousels">
                    <div class="carouseldn">
                        <a href="{{route('media.movie',['id'=>$item->post->id])}}">
                            <img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}">
                        </a>
                      <div class="productdesc">
                        <a href="{{route('media.movie',['id'=>$item->post->id])}}">{{$item->title}}</a>
                        <p>{!! \Illuminate\Support\Str::limit($item->post->description, 85, ' ...') !!}</p>
                        <a href="{{route('media.movie',['id'=>$item->post->id])}}" class="viewprd">مشاهده فیلم</a>
                      </div>
                    </div>
                  </div>
            </div>
            @endforeach
            <ul class="pagination" style="margin-top: 40px;">
                {{$movies->links()}}
             </ul>
        </div>
      </div>
    </div>
  </section>
@endsection
