@extends('layouts.frontend.base')
@section('contents')
<div id="banner-area" class="banner-area" style="background-image: url('../frontend/images/banner/banner1.jpg');">
    <div class="banner-text">
      <div class="container">
          <div class="row">
            <div class="col-lg-12">
                <div class="banner-heading">
                  <h1 class="banner-title">{{$title}}</h1>
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="">{{$title}}</a></li>
                      </ol>
                  </nav>
                </div>
            </div><!-- Col end -->
          </div><!-- Row end -->
      </div><!-- Container end -->
    </div><!-- Banner text end -->
  </div><!-- Banner area end --> 
<section id="main-container" class="main-container pb-2">
    <div class="container">
      <div class="row">
  
        @forelse ($items as $item)
        <div class="col-lg-4 col-md-6 mb-5">
          <a href="{{ url('item-details', $item->slug) }}">
          <div class="ts-service-box">
              @php
                  $image = app('app\Http\Controllers\Frontend\MainController')->firstImage($item->id);
              @endphp
              <div class="ts-service-image-wrapper">
                <img loading="lazy" class="w-100 image" src="{{ url($image) }}" onerror=this.src="{{url('images/noimage.jpg')}}" alt="service-image">
              </div>
              <div class="d-flex">
                <div class="ts-service-info">
                    <h3 class="service-box-title">{{$item->name}}</h3>
                    <p>{!! substr($item->description , 0, 200) !!} {!! strlen(strip_tags($item->description)) > 200 ? '...' : '' !!}</p>
                    <a class="learn-more d-inline-block" href="{{ url('item-details', $item->slug) }}"><i class="fa fa-caret-right"></i> read more</a>
                </div>
              </div>
          </div><!-- Service1 end -->
          </a>
        </div><!-- Col 1 end -->
        @empty
            <p class="text-center px-5 mb-4">Sorry! There is no data fo now!</p>
        @endforelse
      </div><!-- Main row end -->
    </div><!-- Conatiner end -->
  </section><!-- Main container end -->
  @endsection