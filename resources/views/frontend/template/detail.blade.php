@extends('layouts.frontend.base')
@section('contents')
<div id="banner-area" class="banner-area" style="background-image: url('../frontend/images/banner/banner1.jpg');">
    <div class="banner-text">
      <div class="container">
          <div class="row">
            <div class="col-lg-12">
                <div class="banner-heading">
                  <h1 class="banner-title">{{$item->name}}</h1>
                 
                </div>
            </div><!-- Col end -->
          </div><!-- Row end -->
      </div><!-- Container end -->
    </div><!-- Banner text end -->
  </div><!-- Banner area end --> 
<section id="main-container" class="main-container pb-2">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-6 mt-5 mt-lg-0">
              
              <div id="page-slider" class="page-slider small-bg">
                  @php
                    $active = 0;
                  @endphp
                  @forelse ($item->images as $image)
                      <div class="item" style="background-image:url(images/slider-pages/slide-page1.jpg)">
                        <div class="container">
                            <div class="box-slider-content">
                              <div class="box-slider-text">
                                  <h2 class="box-slide-title">{{ $active == 0 ? 'active' : '' }}</h2>
                              </div>    
                            </div>
                        </div>
                      </div><!-- Item 1 end -->
                      @php
                          $active += 1;
                      @endphp
                  @empty
                      <img src="{{url('images/noimage.jpg')}}" alt="">
                  @endforelse
              </div><!-- Page slider end-->         
            </div><!-- Col end -->


            <div class="col-lg-6">
                <h3 class="column-title">{{$item->name}} Details</h3>
                <p>{!! $item->description !!}</p>
            </div><!-- Col end -->
      
        </div><!-- Content row end -->
    
      </div><!-- Container end -->
  </section><!-- Main container end -->
  @endsection