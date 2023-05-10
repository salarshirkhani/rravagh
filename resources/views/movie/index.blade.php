@extends('layouts.frontt')
@section('content')
<style>
    .firstset{
        margin-bottom:25px;
    }
    .productfoot {
      position: relative;
      bottom: 8px;
    }
</style>
<div class="container-fluid">
    <div class="row">
      <div class="intro-media">
        <img src="img/intro-media.png" alt="">
        <form action="{{ route('productsearch') }}" method="post">
            @csrf
            <input type="search" name="qm" id="" placeholder="جست و جو در فیلم‌ها ...">
            <input type="image" src="{{asset('img/Search_alt.svg')}}" alt="submit">
        </form>
        <div class="introtags">
        @foreach ($tags as $tag)
            <span class="introtag"><a href="{{route('/')}}/media/tags?q={{$tag->name}}">{{$tag->name}}</a></span>
        @endforeach
        </div>
      </div>
    </div>
</div>
<div class="container">
    <div class="row">
@foreach ($moviecategories as $category)
<div class="firstset">
    <div class="carouseltitle">                 
        <h2>
        <!---
            <svg width="63" height="58" viewBox="0 0 63 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M31.5 53.25C45.7298 53.25 57.625 42.5835 57.625 29C57.625 15.4165 45.7298 4.75 31.5 4.75C17.2702 4.75 5.375 15.4165 5.375 29C5.375 42.5835 17.2702 53.25 31.5 53.25Z" stroke="#5D5FEF" stroke-width="5" stroke-linecap="round"/>
                <ellipse cx="23.625" cy="24.1667" rx="2.625" ry="2.41667" fill="#5D5FEF" stroke="#5D5FEF" stroke-width="4" stroke-linecap="round"/>
                <ellipse cx="39.8054" cy="24.1667" rx="2.625" ry="2.41667" fill="#5D5FEF" stroke="#5D5FEF" stroke-width="4" stroke-linecap="round"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1536 36.25C19.8789 36.25 19.7415 36.25 19.6664 36.3434C19.5914 36.4368 19.6199 36.5663 19.677 36.8255C20.7751 41.8122 25.6558 45.5714 31.5105 45.5714C37.3653 45.5714 42.246 41.8122 43.3441 36.8255C43.4012 36.5663 43.4297 36.4368 43.3546 36.3434C43.2796 36.25 43.1422 36.25 42.8674 36.25H20.1536Z" fill="#5D5FEF"/>
            </svg>  
        --> 
             <span><a href="{{route('media.category',['slug'=>$category->slug])}}">{{$category->name}}</a></span>
        </h2>
    </div>
    <div class="topcarousel">
      
       @foreach ($movies->where('category',$category->id) as $item)
        <div class="carousel-cell carousels">
            <div class="carouseldn">
            <a href="{{route('media.movie',['id'=>$item->id])}}">
                <img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}">
            </a>
            <div class="productdesc">
                <a href="{{route('media.movie',['id'=>$item->id])}}">
                    <h4>{{$item->title}}</h4>
                </a>
                <p class="productshort">{!! \Illuminate\Support\Str::limit($item->description, 85, ' ...') !!}</p>
                <div class="productfoot">
                    <a href="{{route('media.movie',['id'=>$item->id])}}" class="addtocart toastrDefaultInfo">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="3" stroke="#CCD2E3" stroke-width="2"></circle>
                            <path d="M20.188 10.9343C20.5762 11.4056 20.7703 11.6412 20.7703 12C20.7703 12.3588 20.5762 12.5944 20.188 13.0657C18.7679 14.7899 15.6357 18 12 18C8.36427 18 5.23206 14.7899 3.81197 13.0657C3.42381 12.5944 3.22973 12.3588 3.22973 12C3.22973 11.6412 3.42381 11.4056 3.81197 10.9343C5.23206 9.21014 8.36427 6 12 6C15.6357 6 18.7679 9.21014 20.188 10.9343Z" stroke="#CCD2E3" stroke-width="2"></path>
                        </svg>    
                        مشاهده
                    </a>
                </div>
            </div>  
          </div>
        </div>
      @endforeach
        </div>
    </div>

@endforeach
</div>
</div>
</div>

@endsection