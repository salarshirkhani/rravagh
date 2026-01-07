@extends('layouts.frontt')
@section('content')
<section class="content">
    <div class="container">

    @foreach ($moviecategories as $category)

    <div class="phoneset">
      <div class="carouseltitle">
        <h2>{{$category->name}}
            @isset($category->parent_id)
     {{$category->parent->id}}
    @endisset
        </h2>
          <a href="{{route('media.category',['slug'=>$category->slug])}}" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
          </svg>
          </a>
      </div>  
      <div class="firstcarousel" >
       @foreach ($movies->where('category',$category->id) as $item)
        <div class="carousel-cell carousels">
          <div class="carouseldn">
            <a href="{{route('media.movie',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}"></a>
            <div class="productdesc">
              <a href="{{route('media.movie',['id'=>$item->id])}}">{{$item->title}}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->description, 85, ' ...') !!}</p>
              <a href="{{route('media.movie',['id'=>$item->id])}}" class="viewprd">مشاهده فیلم</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    @endforeach
    @foreach ($moviecategories as $category)
    <div class="firstset">
      <div class="carouseltitle">
        <h2>{{$category->name}}</h2>
          <a href="{{route('media.category',['slug'=>$category->slug])}}" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
          </svg>
          </a>
      </div>  
      <div class="firstcarousel" >
       @foreach ($movies->where('category',$category->id) as $item)
        <div class="carousel-cell carousels">
          <div class="carouseldn">
            <a href="{{route('media.movie',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}"></a>
            <div class="productdesc">
              <a href="{{route('media.movie',['id'=>$item->id])}}">{{$item->title}}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->description, 85, ' ...') !!}</p>
              <a href="{{route('media.movie',['id'=>$item->id])}}" class="viewprd">مشاهده فیلم</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    @endforeach
  </div>
</section>
    </div>
</section>
@endsection