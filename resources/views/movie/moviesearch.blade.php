@extends('layouts.frontt')
@section('content')
<div class="container">
    <div class="products">
        <div class="container">
            <div class="firstset">
                <div class="archiveheader">
                    <div class="archivetitle">                 
                        <h2> 
                            نتیجه جست و جو
                        </h2>
                        <p>بهترین  فیلم دیجی ریحان را در اینجا مشاهده کنید</p>
                    </div>
                </div>

                <div id="London" class="tabcontent">
                    <div class="row">
                        @foreach ($movies as $item)
                        <div class="col-md-3 col-xs-12">    
                            <div class="carousels">
                                <a href="{{route('media.movie',['id'=>$item->id])}}">
                                    <img src="{{ asset('pics/'.$item->post->image.'/'.$item->post->image ) }}" alt="{{$item->post->title}}">
                                </a>
                                 <div class="productdesc">
                                    <a href="{{route('media.movie',['id'=>$item->post->id])}}">
                                            <h4>{{$item->post->title}}</h4>
                                        </a>
                                        <p class="productshort">{!! \Illuminate\Support\Str::limit($item->post->description, 85, ' ...') !!}</p>
                                        <div class="productfoot">
                                            <a href="{{route('media.movie',['id'=>$item->post->id])}}" class="addtocart toastrDefaultInfo">
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

                <div id="Paris" class="tabcontent">
                    <div class="row">
                      @foreach ($movies->where('cheap','!=',NULL) as $item)
                        <div class="col-md-3 col-xs-12">    
                            <div class="carousels">
                                <a href="{{route('product',['id'=>$item->id])}}">
                                    <img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}">
                                </a>
                                 <div class="productdesc">
                                        <a href="{{route('product',['id'=>$item->id])}}">
                                            <h4>{{$item->title}}</h4>
                                        </a>
                                        <p class="productshort">{!! \Illuminate\Support\Str::limit($item->description, 85, ' ...') !!}</p>
                                        <div class="productfoot">
                                            <a href="{{route('movie',['id'=>$item->id])}}" class="addtocart toastrDefaultInfo">
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

            </div>
        </div>
    </div>
</div>
@endsection
