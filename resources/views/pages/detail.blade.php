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
        <div class="page-content page-details">
            <section class="kost-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Kost Details
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <section class="store-gallery mb-3" id="gallery">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                      <transition name="slide-fade" mode="out-in">
                        <img
                        :src="photos[activePhoto].url"
                        :key="photos[activePhoto].id"
                        alt=""
                        class="w-100 main-image"/>
                      </transition>
                    </div>
                    <div class="col-lg-2">
                      <div class="row">
                        <div class="col-3 col-lg-12 mt-2 mt-lg-0"
                          v-for="(photo, index) in photos"
                          :key="photo.id"
                          data-aos="zoom-in" data-aos-delay="100"
                        >
                          <a href="#" @click="changeActive(index)">
                            <img :src="photo.url"
                            class="w-100 thumbnail-image"

                            alt=""/>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
        </div>

    </main>



@include('includes.main.footer')


@include('includes.main.script')
</body>
</html>
