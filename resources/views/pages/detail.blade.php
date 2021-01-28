<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  {{-- <link  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

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
                                        <a href="{{ route('home') }}">Home</a>
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
                        <div class="price">Rp 700.000 / Per Bulan</div>
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

                        <div class="card-body shadow-lg p-3 mb-5 bg-white rounde">
                            <div class="form-group">
                                <label>Pilih Kamar</label>
                                <select name="room" id="room" class="form-control">
                                    <option value="room">Kamar Standar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Pilih tanggal masuk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                      </div>
                                    </div>
                                    <input type="text" class="form-control" id="date" name="date" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duration">Durasi Sewa</label>
                                <select name="duration" id="duration" class="form-control">
                                    <option value="1">1 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">1 Tahun</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-success px-4 text-white btn-block mb-3" data-toggle="modal" data-target="#modal-konfirmasi">
                                Pesan Kamar
                            </button>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <h4>Fasilitas</h4>
                              <div class="card-body">

                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
        </div>
    </main>
<!-- Modal -->
<div class="modal fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    Add rows here
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM

    });
</script>



@include('includes.main.footer')


@include('includes.main.script')
@push('addon-script')
<script src="{{ url('/vue/vue.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $("#datepicker").datepicker({
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
              url: "/seapalace/img/gallery/g2.png",
            },
            {
              id: 3,
              url: "/seapalace/img/gallery/g3s.png",
            },
            {
              id: 4,
              url: "/seapalace/img/gallery/g4.png",
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
<script type="text/javascript">
    $(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>
@endpush

</body>
</html>
