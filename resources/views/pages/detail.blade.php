<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

  @include('includes.main.style')
  @include('includes.main.styledetail');
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
                        <img src="{{ asset('/seapalace/img/gallery/g1.png') }}"
                        {{-- :src="photos[activePhoto].url"
                        :key="photos[activePhoto].id" --}}
                        alt=""
                        class="w-50 main-image"/>
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
              <div class="store-details-container" data-aos="fade-up">
                <section class="store-heading">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-8">
                        <h1>Tipe Kamar</h1>
                        <div class="owner">Kamar Standar</div>
                        <div class="price">$1,500</div>
                        <div class="store-description">
                            <div class="container">
                              <div class="row">
                                <div class="col-12 col-lg-8">
                                  <p>The Nike Air Max 720 SE goes bigger than ever before with Nike's tallest Air unit yet for unimaginable, all-day comfort. There's super breathable fabrics on the upper, while colours add a modern edge.</p>
                                  <p>Bring the past into the future with the Nike Air Max 2090, a bold look inspired by the DNA of the iconic Air Max 90. Brand-new Nike Air cushioning underfoot adds unparalleled comfort while transparent mesh and vibrantly coloured details on the upper are blended with timeless OG features for an edgy, modernised look.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="col-lg-4" data-aos="zoom-in">
                        <div class="card-body shadow-lg p-3 mb-5 bg-white rounde" style="background: grey;">
                            <div class="price">Rp 600.000 / bulan</div>
                            <div class="form-group">
                                <label>Pilih Kamar</label>
                                <select name="room" id="room" class="form-control">
                                    <option value="room">Kamar K1L1</option>
                                    <option value="room">Kamar K1L2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Pilih tanggal masuk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                      </div>
                                    </div>
                                    <input type="text" class="form-control datepicker" id="datepicker">
                                  </div>
                            </div>
                            <div class="form-group">
                                <label for="duration">Durasi Sewa</label>
                                <input type="number" value="1">
                            </div>
                            <a href="/cart.html" class="btn btn-success px-4 text-white btn-block mb-3">
                                Pesan Kamar
                              </a>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </section>

                <section class="store-review">
                  <div class="container">
                    <div class="row">
                      <div class="col-12 col-lg-8 mt-3 mb-3">
                        <h5>Customer Review (3)</h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-lg-8">
                        <ul class="list-unstyled">
                          <li class="media">
                            <img src="/images/pic_review-1.png" alt="" class="mr-3 rounded-circle">
                             <div class="media-body">
                               <h5 class="mt-2 mb-1">Noah</h5>
                               I thought it was not good for living room. I really happy
        to decided buy this product last week now feels like homey.
                             </div>
                          </li>
                          <li class="media">
                            <img src="/images/pic_review-1.png" alt="" class="mr-3 rounded-circle">
                             <div class="media-body">
                               <h5 class="mt-2 mb-1">Sutrisna</h5>
                               Color is great with the minimalist concept. Even I thought it was
        made by Cactus industry. I do really satisfied with this.
                             </div>
                          </li>
                          <li class="media">
                            <img src="/images/pic_review-1.png" alt="" class="mr-3 rounded-circle">
                             <div class="media-body">
                               <h5 class="mt-2 mb-1">Luna</h5>
                               When I saw at first, it was really awesome to have with.
        Just let me know if there is another upcoming product like this.
                             </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
        </div>

    </main>



@include('includes.main.footer')


@include('includes.main.script')
</body>
</html>
@push('addon-script')
<script src="/vue/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,

        });
    });

    var gallery = new Vue({
        el: "#gallery",
        mounted(){
          AOS.init();
        },
        data: {
          activePhoto: 1,
          photos: [
            {
              id: 1,
              url: "/seapalace/img/gallery/g1.png",
            },
            {
              id: 2,
              url: "/images/products-details-2.jpg",
            },
            {
              id: 3,
              url: "/images/products-details-3.jpg",
            },
            {
              id: 4,
              url: "/images/products-details-4.jpg",
            },
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
        },
      });
</script>
@endpush
