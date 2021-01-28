<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>

  @include('includes.main.style')
</head>
<body>
	@include('includes.main.navbar')
  <main class="site-main">


    <!-- ================ start banner area ================= -->
    <section class="home-banner-area" id="home">
      <div class="container h-40">
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
              <h2 class="mb-4">Selamat Datang</h2>
              <p>Beginning blessed second a creepeth. Darkness wherein fish years good air whose after seed appear midst evenin, appear void give third bearing divide one so blessed moved firmament gathered </p>
              <p>Beginning blessed second a creepeth. Darkness wherein fish years good air whose after seed appear midst evenin, appear void give third bearing divide one so blessed</p>
              <a class="button button--active home-banner-btn mt-4" href="#kost">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ welcome section end ================= -->


    <!-- ================ Explore section start ================= -->
    <section class="section-margin" id="kost">
      <div class="container">
        <div class="section-intro text-center pb-80px">
          <h2>Tipe Kamar Rumah Kost Griya Kenyo</h2>
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
                <a class="card-explore__link" href="{{ route('detail-kost') }}">Book Now <i class="ti-arrow-right"></i></a>
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

     <!-- ================ carousel section start ================= -->
     <section class="section-margin">
        <div class="container">
          <div class="section-intro text-center pb-20px">
            <h2>Review Penghuni</h2>
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



  @include('includes.main.footer')


 @include('includes.main.script')
</body>
</html>
