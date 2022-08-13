<section id="news" class="news">
    <div class="container">
      <div class="row text-center">
          <div class="col-12">
            <h2 class="section-title">Work of Excellence</h2>
            <h3 class="section-sub-title">Recent Projects</h3>
          </div>
      </div>
      <!--/ Title row end -->
  
      <div class="row">

        @forelse ($news as $new)

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="latest-post">
                <div class="latest-post-media">
                  <a href="news-single.html" class="latest-post-img">
                      <img loading="lazy" class="img-fluid" src="{{ url($new->image) }}" alt="img">
                  </a>
                </div>
                <div class="post-body">
                  <h4 class="post-title">
                      <a href="news-single.html" class="d-inline-block">{{$new->title}}</a>
                  </h4>
                  <div class="latest-post-meta">
                      <span class="post-item-date">
                        <i class="fa fa-clock-o"></i>{{$new->created_at}}
                      </span>
                  </div>
                </div>
            </div><!-- Latest post end -->
          </div><!-- 1st post col end -->
          @empty
              <p class="text-center px-5 mb-4">Sorry! There is no data fo now!</p>
          @endforelse
      </div>
      <!--/ Content row end -->
  
      <div class="general-btn text-center mt-4">
          <a class="btn btn-primary" href="news-left-sidebar.html">See All Posts</a>
      </div>
  
    </div>
    <!--/ Container end -->
  </section>
  <!--/ News end -->