<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Shan Blog</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">

  <link rel="stylesheet" href="{{asset('vendors/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/themify-icons/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/linericon/style.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.carousel.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="{{route('primary')}}"> <h1>Shan Blog</h1> </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-center">
              <li class="nav-item active"><a class="nav-link" href="{{route('primary')}}">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('pages.archive')}}">Archive</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('pages.contact')}}">Contact</a></li>
              @if (Route::has('login'))

              @auth
              <li class="nav-item">
                  <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
              </li>
              @else
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>

                  @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">Register</a>
                  </li>
                  @endif
              @endauth

      @endif

            </ul>
            <ul class="nav navbar-nav navbar-right navbar-social">
              <li><a href="#"><i class="ti-facebook"></i></a></li>
              <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li><a href="#"><i class="ti-instagram"></i></a></li>
              <li><a href="#"><i class="ti-skype"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

  <main class="site-main">
    <!--================Hero Banner start =================-->
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner">
          <div class="hero-banner__content">
            <h1>Welcome to Shan Blog</h1>
            <h4>Share Your Thoughts or Experience With Us</h4>
            <h3>Laravel Based Blog Site With Register, Login, Post, Tag, Comments Features </h3>
            
          </div>
        </div>
      </div>
    </section>
    <!--================Hero Banner end =================-->

    <!--================ Blog slider start =================-->
    <section>
      <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
            @foreach ($posts as $post)
            <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="{{asset($post->image)}}" alt="image" style="width:350px;height:230px">
              </div>
              <div class="blog__slide__content">
                <a class="blog__slide__label" href="#">{{$post->category->name}}</a>
                <h3><a href="{{route('posts.show',$post->id)}}">{{$post->title}}</a></h3>
                <p>{{$post->created_at->diffForHumans()}}</p>
              </div>
            </div>
            @endforeach

        </div>
      </div>
    </section>
    <!--================ Blog slider end =================-->

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
              @foreach ($postsP as $post)
              <div class="single-recent-blog-post">
                <div class="thumb">
                  <img class="img-fluid" src="{{asset($post->image)}}" alt="post image">
                  <ul class="thumb-info">
                    <li><a href="#"><i class="ti-user"></i>{{$post->user->name}}</a></li>
                    <li><a href="#"><i class="ti-notepad"></i>{{$post->created_at->format('Y.m.d')}}</a></li>
                    <li><a href="#"><i class="ti-themify-favicon"></i>{{count($post->comment)}} Comments</a>
                    <ul>
                      @foreach($post->comment as $comm)
                      <li><b>->{{$comm->comment}}--Commented By {{$comm->user->name}}</b></li>
                      @endforeach
                    </ul>
                    <div>
                      <form role="search" method="post" class="search-form" action="{{route('comment.store')}}">
                      @csrf
                        <label for="search-input" id="shanComment" class="search-label">
                          Comment:   
                        </label>
                        <input id="{{$post->id}}" type="search" class="search-input" placeholder="Write a comment" value="" name="comment" title="Search for:" />
                        <input type="hidden" value="{{$post->id}}" name="post_id" />
                        <input type="submit" class="search-submit" value="Save" />
                      </form>
                    </div>
                    </li>
                  </ul>
                </div>
                <div class="details mt-20">
                  <a href="blog-single.html">
                    <h3>{{$post->title}}</h3>
                  </a>
                  <p class="tag-list-inline">Tag: /
                    @foreach ($tags as $tag)
                        @if ($post->hastags($tag->id))

                        {{$tag->name}} /
                        @endif
                @endforeach
                  </p>
                  <p>{{$post->description}}</p>
                  <a class="button" href="{{route('posts.show',$post->id)}}">Read More <i class="ti-arrow-right"></i></a>
                </div>
              </div>
              @endforeach





            <div class="row">
              <div class="col-lg-12">
                  <nav class="blog-pagination justify-content-center d-flex">
                    {{$postsP->links()}}

                  </nav>
              </div>
            </div>
          </div>

          <!-- Start Blog Post Siddebar -->
          <div class="col-lg-4 sidebar-widgets">
              <div class="widget-wrap">
                <div class="single-sidebar-widget newsletter-widget">
                  <h4 class="single-sidebar-widget__title">Newsletter</h4>
                  <div class="form-group mt-30">
                    <div class="col-autos">
                      <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email'">
                    </div>
                  </div>
                  <button class="bbtns d-block mt-20 w-100">Subcribe</button>
                </div>


                <div class="single-sidebar-widget post-category-widget">
                  <h4 class="single-sidebar-widget__title">Category</h4>
                  <ul class="cat-list mt-20">
                      @foreach ($categories as $category)
                      <li>
                        <a href="#" class="d-flex justify-content-between">
                          <p>{{$category->name}}</p>
                          <p>({{$category->posts->count()}})</p>
                        </a>
                      </li>
                      @endforeach
                  </ul>
                </div>

                <div class="single-sidebar-widget popular-post-widget">
                  <h4 class="single-sidebar-widget__title">Latest Post</h4>
                  <div class="popular-post-list">
                      @foreach($latest as $item)

                      <div class="single-post-list">
                        <div class="thumb">
                          <img class="card-img rounded-0" src="{{asset($item->image)}}" alt="">
                          <ul class="thumb-info">
                            <li><a href="#">{{$item->user->name}}</a></li>
                            <li><a href="#">{{$item->created_at->format('Y.m.d')}}</a></li>
                          </ul>
                        </div>
                        <div class="details mt-20">
                          <a href="{{route('posts.show',$item->id)}}">
                            <h6>{{$item->title}}</h6>
                          </a>
                        </div>
                      </div>
                      @endforeach
                  </div>
                </div>

                  <div class="single-sidebar-widget tag_cloud_widget">
                    <h4 class="single-sidebar-widget__title">Tags</h4>
                    <ul class="list">
                        @foreach ($tags as $tag)

                        <li>
                            <a href="#">{{$tag->name}}</a>
                        </li>
                        @endforeach

                    </ul>
                  </div>
                </div>
              </div>
            </div>
          <!-- End Blog Post Siddebar -->
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
  </main>

  <!--================ Start Footer Area =================-->
  <footer class="footer-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>About Us</h6>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
              magna aliqua.
            </p>
          </div>
        </div>
        <div class="col-lg-4  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Newsletter</h6>
            <p>Stay update with our latest</p>
            <div class="" id="mc_embed_signup">

              <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                method="get" class="form-inline">

                <div class="d-flex flex-row">

                  <input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
                    required="" type="email">


                  <button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
                  <div style="position: absolute; left: -5000px;">
                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                  </div>

                  <!-- <div class="col-lg-4 col-md-4">
                        <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                      </div>  -->
                </div>
                <div class="info"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget mail-chimp">
            <h6 class="mb-20">Instragram Feed</h6>
            <ul class="instafeed d-flex flex-wrap">
              <li><img src="{{asset('img/instagram/i1.jpg')}}" alt=""></li>
              <li><img src="{{asset('img/instagram/i2.jpg')}}" alt=""></li>
              <li><img src="{{asset('img/instagram/i3.jpg')}}" alt=""></li>
              <li><img src="{{asset('img/instagram/i4.jpg')}}" alt=""></li>
              <li><img src="{{asset('img/instagram/i5.jpg')}}" alt=""></li>
              <li><img src="{{asset('img/instagram/i6.jpg')}}" alt=""></li>
              <li><img src="{{asset('img/instagram/i7.jpg')}}" alt=""></li>
              <li><img src="{{asset('img/instagram/i8.jpg')}}" alt=""></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Follow Us</h6>
            <p>Let us be social</p>
            <div class="footer-social d-flex align-items-center">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-dribbble"></i>
              </a>
              <a href="#">
                <i class="fab fa-behance"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      </div>
    </div>
  </footer>
  <!--================ End Footer Area =================-->

  <script src="{{asset('vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{asset('js/mail-script.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>

  <script type="text/javascript">
    document.getElementById("shanComment").addEventListener("click", function(e) {
      if (e.target == this) {
        e.preventDefault();
        this.classList.toggle("clicked");
      }
    });
  </script>
</body>
</html>
