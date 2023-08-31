<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
================================================== -->
  <meta charset="utf-8">
  <title>Farming city</title>

  <!-- Mobile Specific Metas
================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Farming City official site">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">

  <!-- Favicon
  ================================================== -->
  <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

  <!-- CSS
    ================================================== -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ url ('frontend/plugins/bootstrap/bootstrap.min.css') }}">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="{{ url ('frontend/plugins/fontawesome/css/all.min.css') }}">
  <!-- Animation -->
  <link rel="stylesheet" href="{{ url ('frontend/plugins/animate-css/animate.css') }}">
  <!-- slick Carousel -->
  <link rel="stylesheet" href="{{ url ('frontend/plugins/slick/slick.css' )}}">
  <link rel="stylesheet" href="{{ url ('frontend/plugins/slick/slick-theme.css')}}">
  <!-- Colorbox -->
  <link rel="stylesheet" href="{{ url ('frontend/plugins/colorbox/colorbox.css')}}">
  <!-- Template styles-->
  <link rel="stylesheet" href="{{ url ('frontend/css/style.css')}}">
  <style type="text/css">
    .image{
      height: 200px;
      width: 250px;
    }
  </style>

</head>
<body>
  <div class="body-inner">

    <div id="top-bar" class="top-bar">
        <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-8">
                <ul class="top-info text-center text-md-left">
                    <li><i class="fas fa-map-marker-alt"></i> <p class="info-text">112 Farming City LTD Dar es Salaam , Tanzania</p>
                    </li>
                </ul>
              </div>
              <!--/ Top info end -->
  
              <div class="col-lg-4 col-md-4 top-social text-center text-md-right">
                <ul class="list-unstyled">
                    <li>
                      <a title="Facebook" href="https://facebbok.com/themefisher.com">
                          <span class="social-icon"><i class="fab fa-facebook-f"></i></span>
                      </a>
                      <a title="Twitter" href="https://twitter.com/themefisher.com">
                          <span class="social-icon"><i class="fab fa-twitter"></i></span>
                      </a>
                      <a title="Instagram" href="https://instagram.com/themefisher.com">
                          <span class="social-icon"><i class="fab fa-instagram"></i></span>
                      </a>
                      <a title="Linkdin" href="https://github.com/themefisher.com">
                          <span class="social-icon"><i class="fab fa-github"></i></span>
                      </a>
                    </li>
                </ul>
              </div>
              <!--/ Top social end -->
          </div>
          <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </div>
    <!--/ Topbar end -->
<!-- Header start -->
<header id="header" class="header-one">
  <div class="bg-white">
    <div class="container">
      <div class="logo-area">
          <div class="row align-items-center">
            <div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
                <a class="d-block" href="index.html">
                   {{-- <img src="{{ url('frontend/images/FARMING1.jpg') }}" alt="Constra">  --}}
                  <h1 class="logo"><a class="logo-top" href="index.html">Farming City Company LTD<span></span></a></h1>
                </a>
            </div><!-- logo end -->
  
            <div class="col-lg-9 header-right">
                <ul class="top-info-box">
                  <li>
                    <div class="info-box">
                      <div class="info-box-content">
                          <p class="info-box-title">Call Us</p>
                          <p class="info-box-subtitle"><a href="tel:+255788645399">(+255)788645399</a></p>
                          <p class="info-box-subtitle"><a href="tel:+255712900734">(+255)712900734</a></p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="info-box">
                      <div class="info-box-content">
                          <p class="info-box-title">Email Us</p>
                          <p class="info-box-subtitle"><a href="mailto:farmingcit@gmail.com">farmingcit@gmail.com</a></p>
                          <p class="info-box-subtitle"><a href="mailto:info@farmingcity.co.tz">info@farmingcity.co.tz</a></p>
                      </div>
                    </div>
                  </li>
                  <li class="info-box">
                    <div class="info-box last">
                      <div class="info-box-content">
                          <p class="info-box-title">TIN</p>
                          <p class="info-box-subtitle">149-984-151</p>
                      </div>
                    </div>
                  </li>
                   <li class="last">
                    <div class="info-box last">
                      <div class="info-box-content">
                          <p class="info-box-title">VRN</p>
                          <p class="info-box-subtitle">40-047746-V</p>
                      </div>
                    </div>
                  </li>
                  <li class="header-get-a-quote">
                    <a class="btn btn-primary" href="contact.html">cONTACT US</a>
                  </li>
                </ul><!-- Ul end -->
            </div><!-- header right end -->
          </div><!-- logo area end -->
  
      </div><!-- Row end -->
    </div><!-- Container end -->
  </div>

  <div class="site-navigation">
    <div class="container">
        <div class="row">
          <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div id="navbar-collapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav mr-auto">
                      <li class="nav-item"><a class="nav-link" href="{{url('/')}}">HOME</a></li>
                     

                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">CLEANING MATERIALS <i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('cleaning-materials', 'safety-gears') }}">Safety Gears</a></li>
                            <li><a href="{{ url('cleaning-materials', 'soap-and-dertegents') }}">Soap & detergents</a></li>
                            <li><a href="{{ url('cleaning-materials', 'waste-management-facilities') }}">Waste Management Facilities</a></li>
                            <li><a href="{{ url('cleaning-materials', 'cleaning-tools') }}">Cleaning tools</a></li>
                            
                          </ul>
                      </li>
              
                      <li class="nav-item dropdown">
                          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">FOOD & BEVERAGE <i class="fa fa-angle-down"></i></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('food-and-beverage', 'beverage') }}">Beverage</a></li>
                            <li><a href="{{ url('food-and-beverage', 'soft-drinks') }}">Soft drinks</a></li>
                            <li><a href="{{ url('food-and-beverage', 'cereals') }}">Cereals</a></li>
                            <li><a href="{{ url('food-and-beverage', 'tubers') }}">Tubers</a></li>
                            <li><a href="{{ url('food-and-beverage', 'fish-meat') }}">Fish & Meat</a></li>
                          </ul>
                      </li>
                      <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">LABORATORY EQUIPMENT & SUPPLIES <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ url('laboratory-equipment-and-supplies', 'apparatii') }}">Apparatii</a></li>
                          <li><a href="{{ url('laboratory-equipment-and-supplies', 'balances') }}">Balances</a></li>
                          <li><a href="{{ url('laboratory-equipment-and-supplies', 'models') }}">Models</a></li>
                          <li><a href="{{ url('laboratory-equipment-and-supplies', 'microscopes') }}">Microscopes</a></li>
                          <li><a href="{{ url('laboratory-equipment-and-supplies', 'chemicals-and-reagents') }}">Chemicals and Reagents</a></li>
                          <li><a href="{{ url('laboratory-equipment-and-supplies', 'specimens') }}">Specimens</a></li>
                        </ul>
                    </li>
                      <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">KITCHEN APPLIANCES<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('sports-and-games', 'untensils') }}">Untensils</a></li>
                              <li><a href="{{ url('sports-and-games', 'gadgets') }}">Gadgets</a></li>
                              <li><a href="{{ url('sports-and-games', 'gas-cylinders') }}">Gas cylinders</a></li>
                        </ul>
                      </li>
                      <li class="nav-item dropdown"><a  class="nav-link dropdown-toggle" data-toggle="dropdown" >OTHERS<i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{{ url('others', 'beddings') }}">Beddings</a></li>
                          <li><a href="{{ url('others', 'clothing-materials') }}">Clothing Materials</a></li>
                          <li><a href="{{ url('others', 'mattresses') }}">Mattresses</a></li>
                          <li><a href="{{ url('others', 'sports-wears') }}">Sports Wears</a></li>
                        </ul>
                      </li>
                    </ul>
                </div>
              </nav>
          </div>
          <!--/ Col end -->
        </div>
        <!--/ Row end -->

        <div class="nav-search">
          <span id="search"><i class="fa fa-search"></i></span>
        </div><!-- Search end -->

        <div class="search-block" style="display: none;">
          <label for="search-field" class="w-100 mb-0">
            <input type="text" class="form-control" id="search-field" placeholder="Type what you want and enter">
          </label>
          <span class="search-close">&times;</span>
        </div><!-- Site search end -->
    </div>
    <!--/ Container end -->

  </div>
  <!--/ Navigation end -->
</header>
<!--/ Header end -->

 @yield('contents')


  <footer id="footer" class="footer bg-overlay">
    <div class="footer-main">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-4 col-md-6 footer-widget footer-about">
            <h3 class="widget-title">About Us</h3>
            <!-- <img loading="lazy" width="200px" class="footer-logo" src="images/footer-logo.png" alt="Constra"> -->
            <h1 class="logo" style="color: white;"><a href="index.html">Farming City<span>.</span></a></h1>
            <p>We are team of Specialized Supplier of Kitchen Appliances & Supplies, Cleaning Materials and related Supplies,
               Uniforms, Beddings, Sports, Textile materials Supplies and other General Household’s & Office belongings supplies.</p>
            <div class="footer-social">
              <ul>
                <li><a href="https://facebook.com/themefisher" aria-label="Facebook"><i
                      class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://twitter.com/themefisher" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </li>
                <li><a href="https://instagram.com/themefisher" aria-label="Instagram"><i
                      class="fab fa-instagram"></i></a></li>
                <li><a href="https://github.com/themefisher" aria-label="Github"><i class="fab fa-github"></i></a></li>
              </ul>
            </div><!-- Footer social end -->
          </div><!-- Col end -->

          <div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
            <h3 class="widget-title">Working Hours</h3>
            <div class="working-hours">
              We work 7 days a week, every day excluding major holidays. Contact us if you have an emergency, with our
              Hotline and Contact form.
              <br><br> Monday - Friday: <span class="text-right">09:00 - 16:00 </span>
              <br> Saturday: <span class="text-right">12:00 - 15:00</span>
              <br> Sunday and holidays: <span class="text-right">09:00 - 12:00</span>
            </div>
          </div><!-- Col end -->

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
            <h3 class="widget-title">Services</h3>
            <ul class="list-arrow">
              <li><a href="#">CLEANING MATERIALS</a></li>
              <li><a href="#">FOOD AND BEVERAGE</a></li>
              <li><a href="#">KITCHEN APPLIANCE AND ELECTRONICS</a></li>
              <li><a href="#">SPORT GEARS AND CLOTHINGS</a></li>
              <li><a href="#">LABORATORY EQUIPMENTS AND SUPPLIES</a></li>
            </ul>
          </div><!-- Col end -->
        </div><!-- Row end -->
      </div><!-- Container end -->
    </div><!-- Footer main end -->

    <div class="copyright">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="copyright-info text-center text-md-left">
              <span>Copyright &copy; <script>
                  document.write(new Date().getFullYear())
                </script>, Designed &amp; Developed by <a href="https://themefisher.com">DEJNG COMPANY LIMITED</a></span>
            </div>
          </div>

          <div class="col-md-6">
            <div class="footer-menu text-center text-md-right">
              <ul class="list-unstyled">
                <!-- <li><a href="about.html">About</a></li>
                <li><a href="team.html">Our people</a></li>
                <li><a href="faq.html">Faq</a></li>
                <li><a href="news-left-sidebar.html">Blog</a></li>
                <li><a href="pricing.html">Pricing</a></li> -->
              </ul>
            </div>
          </div>
        </div><!-- Row end -->

        <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
          <button class="btn btn-primary" title="Back to Top">
            <i class="fa fa-angle-double-up"></i>
          </button>
        </div>

      </div><!-- Container end -->
    </div><!-- Copyright end -->
  </footer><!-- Footer end -->


  <!-- Javascript Files
  ================================================== -->

  <!-- initialize jQuery Library -->
  <script src="{{ url ('frontend/plugins/jQuery/jquery.min.js')}}"></script>
  <!-- Bootstrap jQuery -->
  <script src="{{ url ('frontend/plugins/bootstrap/bootstrap.min.js')}}" defer></script>
  <!-- Slick Carousel -->
  <script src="{{ url ('frontend/plugins/slick/slick.min.js')}}"></script>
  <script src="{{ url ('frontend/plugins/slick/slick-animation.min.js')}}"></script>
  <!-- Color box -->
  <script src="{{ url ('frontend/plugins/colorbox/jquery.colorbox.js')}}"></script>
  <!-- shuffle -->
  <script src="{{ url ('frontend/plugins/shuffle/shuffle.min.js')}}" defer></script>


  <!-- Google Map API Key-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
  <!-- Google Map Plugin-->
  <script src="{{ url ('frontend/plugins/google-map/map.js')}}" defer></script>

  <!-- Template custom -->
  <script src="{{ url ('frontend/js/script.js')}}"></script>

  </div><!-- Body inner end -->
  </body>

  </html>