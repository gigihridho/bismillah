<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>

  <link rel="icon" href="{{ url('/seapalace/img/favicon.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ url('/seapalace/vendors/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('/seapalace/vendors/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('/seapalace/vendors/themify-icons/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ url('/seapalace/vendors/linericon/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" />

  <link rel="stylesheet" href="{{ url('/seapalace/vendors/magnefic-popup/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{ url('/seapalace/vendors/nice-select/nice-select.css') }}">

  <link rel="stylesheet" href="{{ url('/seapalace/css/style.css') }}">
</head>
<body>
	<!-- ================ header section start ================= -->
	<header class="header_area">
    <div class="header-top">
      <div class="container">
        <div class="d-flex align-items-center">
          <div id="logo">
            <a href="index.html"><img src="{{ url('/seapalace/img/Logo.png')}}" alt="" title="" style="max-width: 50%"  /></a>
          </div>
          <div class="ml-auto d-none d-md-block d-md-flex">
            <div class="media header-top-info">
              <span class="header-top-info__icon"><i class="ti-email"></i></span>
              <div class="media-body">
                <p>Have any question?</p>
                <p>Free: <a href="tel:+12 365 5233">+12 365 5233</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <!-- <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a> -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          </div>

          <ul class="nav navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
            @guest
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign In</a>
            </li>
            @endguest
          </ul>
          &nbsp;
          <ul class="nav navbar-nav">
            @auth
            <!--Desktop Menu-->
            <ul class="navbar-nav d-none d-lg-flex">
             <li class="nav-item dropdown">
               <a href="#" class="nav-link" id="navbar-dropdown" role="button" data-toggle="dropdown">
                 Hi, {{ Auth::user()->name }}
               </a>
               <div class="dropdown-menu">
                 @if(auth()->user()->hasRole('user'))
                 <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                 <a href="#" class="dropdown-item">Settings</a>
                 <div class="dropdown-divider"></div>
                 <a
                 href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                 class="dropdown-item"
                 >
                 Logout
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                 </a>
                 @endif

                 @if(auth()->user()->hasRole('admin'))
                 <a href="{{ route('admin-dashboard') }}" class="dropdown-item">Dashboard</a>
                 <a href="#" class="dropdown-item">Settings</a>
                 <div class="dropdown-divider"></div>
                 <a
                 href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                 class="dropdown-item"
                 >
                 Logout
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                 </a>
                 @endif
               </div>
             </li>
             @endauth
          </ul>
        </div>
      </nav>
    </div>
  </header>
	<!-- ================ header section end ================= -->

  <main class="site-main">


    <!-- ================ start banner area ================= -->
    <section class="home-banner-area" id="home">
      <div class="container h-100">
        <div class="home-banner">
          <div class="text-center">
            <h4>Rumah Kost yang bersih dan nyaman</h4>
            <h1>Rumah Kost Griya Kenyo</h1>
            <a class="button home-banner-btn" href="#">Book Now</a>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ end banner area ================= -->

    <!-- ================ welcome section start ================= -->
    <section class="welcome">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 mb-4 mb-lg-0">
            <div class="row no-gutters welcome-images">
              <div class="col-sm-7">
                <div class="card">
                  <img class="" src="{{ url('/seapalace/img/home/welcomeBanner1.png')}}" alt="Card image cap">
                </div>
              </div>
              <div class="col-sm-5">
                <div class="card">
                  <img class="" src="{{ url('/seapalace/img/home/welcomeBanner2.png')}}" alt="Card image cap">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="card">
                  <img class="" src="{{ url('/seapalace/img/home/welcomeBanner3.png')}}" alt="Card image cap">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="welcome-content">
              <h2 class="mb-4"><span class="d-block">Welcome</span> to our residence</h2>
              <p>Beginning blessed second a creepeth. Darkness wherein fish years good air whose after seed appear midst evenin, appear void give third bearing divide one so blessed moved firmament gathered </p>
              <p>Beginning blessed second a creepeth. Darkness wherein fish years good air whose after seed appear midst evenin, appear void give third bearing divide one so blessed</p>
              <a class="button button--active home-banner-btn mt-4" href="#">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ welcome section end ================= -->


    <!-- ================ Explore section start ================= -->
    <section class="section-margin">
      <div class="container">
        <div class="section-intro text-center pb-80px">
          <div class="section-intro__style">
            <img src="{{ url('/seapalace/img/home/bed-icon.png')}}" alt="">
          </div>
          <h2>Explore Our Rooms</h2>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-explore">
              <div class="card-explore__img">
                <img class="card-img" src="{{ url('/seapalace/img/home/explore1.png')}}" alt="">
              </div>
              <div class="card-body">
                <h3 class="card-explore__price">$150.00 <sub>/ Per Night</sub></h3>
                <h4 class="card-explore__title"><a href="#">Classic Bed Room</a></h4>
                <p>Beginning fourth dominion creeping god was. Beginning, which fly yieldi dry beast moved blessed </p>
                <a class="card-explore__link" href="#">Book Now <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-explore">
              <div class="card-explore__img">
                <img class="card-img" src="{{ url('/seapalace/img/home/explore2.png')}}" alt="">
              </div>
              <div class="card-body">
                <h3 class="card-explore__price">$170.00 <sub>/ Per Night</sub></h3>
                <h4 class="card-explore__title"><a href="#">Premium Room</a></h4>
                <p>Beginning fourth dominion creeping god was. Beginning, which fly yieldi dry beast moved blessed </p>
                <a class="card-explore__link" href="#">Book Now <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-explore">
              <div class="card-explore__img">
                <img class="card-img" src="{{ url('/seapalace/img/home/explore3.png')}}" alt="">
              </div>
              <div class="card-body">
                <h3 class="card-explore__price">$190.00 <sub>/ Per Night</sub></h3>
                <h4 class="card-explore__title"><a href="#">Family Room</a></h4>
                <p>Beginning fourth dominion creeping god was. Beginning, which fly yieldi dry beast moved blessed </p>
                <a class="card-explore__link" href="#">Book Now <i class="ti-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ Explore section end ================= -->

    <!-- ================ special section start ================= -->
    <section class="section-padding bg-porcelain">
      <div class="container">
        <div class="section-intro text-center pb-80px">
          <div class="section-intro__style">
            <img src="{{ url('/seapalace/img/home/bed-icon.png')}}" alt="">
          </div>
          <h2>Special Facilities</h2>
        </div>
        <div class="special-img mb-30px">
          <img class="img-fluid" src="{{ url('/seapalace/img/home/special.png')}}" alt="">
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-special">
              <div class="media align-items-center mb-1">
                <span class="card-special__icon"><i class="ti-home"></i></span>
                <div class="media-body">
                  <h4 class="card-special__title">Conference Room</h4>
                </div>
              </div>
              <div class="card-body">
                <p>Built purse maids cease her ham new seven among and. Pulled coming wooded tended it answer remain</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-special">
              <div class="media align-items-center mb-1">
                <span class="card-special__icon"><i class="ti-bell"></i></span>
                <div class="media-body">
                  <h4 class="card-special__title">Swimming Pool</h4>
                </div>
              </div>
              <div class="card-body">
                <p>Built purse maids cease her ham new seven among and. Pulled coming wooded tended it answer remain</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
            <div class="card card-special">
              <div class="media align-items-center mb-1">
                <span class="card-special__icon"><i class="ti-car"></i></span>
                <div class="media-body">
                  <h4 class="card-special__title">Sports Culb</h4>
                </div>
              </div>
              <div class="card-body">
                <p>Built purse maids cease her ham new seven among and. Pulled coming wooded tended it answer remain</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ special section end ================= -->

     <!-- ================ carousel section start ================= -->
     <section class="section-margin">
        <div class="container">
          <div class="section-intro text-center pb-20px">
            <div class="section-intro__style">
              <img src="{{ url('/seapalace/img/home/bed-icon.png') }}" alt="">
            </div>
            <h2>Our Guest Love Us</h2>
          </div>
          <div class="owl-carousel owl-theme testi-carousel">
            <div class="testi-carousel__item">
              <div class="media">
                <div class="testi-carousel__img">
                  <img src="{{ url('/seapalace/img/home/testimonial1.png') }}" alt="">
                </div>
                <div class="media-body">
                  <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>
                  <div class="testi-carousel__intro">
                    <h3>Robert Mack</h3>
                    <p>CEO & Founder</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="testi-carousel__item">
                <div class="media">
                  <div class="testi-carousel__img">
                    <img src="{{ url('/seapalace/img/home/testimonial1.png') }}" alt="">
                  </div>
                  <div class="media-body">
                    <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>
                    <div class="testi-carousel__intro">
                      <h3>Robert Mack</h3>
                      <p>CEO & Founder</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="testi-carousel__item">
                <div class="media">
                  <div class="testi-carousel__img">
                    <img src="{{ url('/seapalace/img/home/testimonial1.png') }}" alt="">
                  </div>
                  <div class="media-body">
                    <p>Incidunt deleniti blanditiis quas aperiam recusandae consillo ullam quibusdam cum libero illo repell endus!</p>
                    <div class="testi-carousel__intro">
                      <h3>Robert Mack</h3>
                      <p>CEO & Founder</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </section>
      <!-- ================ carousel section end ================= -->

  </main>



  <!-- ================ start footer Area ================= -->
  <footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-xl-4 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Datang ke Lokasi</h4>
					<p>Setiap hari pukul 09.00 - 17.00</p>
				</div>
				<div class="col-xl-4 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Keunggulan</h4>
					<p>Bersih dan Nyaman</p>
				</div>
				<div class="col-xl-4 col-md-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Rumah Kost Griya Kenyo</h4>
					<p>Surakarta Jawa Tengah</p>
				</div>
			</div>
			<div class="footer-bottom row align-items-center text-center text-lg-center">
				<p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
			</div>
		</div>
	</footer>
  <!-- ================ End footer Area ================= -->



  <script src="{{ url('/seapalace/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ url('/seapalace/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ url('/seapalace/vendors/magnefic-popup/jquery.magnific-popup.min.js')}}"></script>
  {{-- <script src="{{ url('/seapalace/vendors/owl-carousel/owl.carousel.min.js')}}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"></script>
  <script src="{{ url('/seapalace/vendors/easing.min.js')}}"></script>
  <script src="{{ url('/seapalace/superfish.min.js')}}"></script>
  <script src="{{ url('/seapalace/vendors/nice-select/jquery.nice-select.min.js')}}"></script>
  <script src="{{ url('/seapalace/vendors/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{ url('/seapalace/vendors/mail-script.js')}}"></script>
  <script src="{{ url('/seapalace/js/main.js')}}"></script>
</body>
</html>
