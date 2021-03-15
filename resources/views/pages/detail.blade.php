<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
  <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd-mm-yyyy"
        }).val();
        // $( "#datepicker").datepicker("show");
    });
  </script>
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
                    @php $incrementRoomType = 0 @endphp
                    @forelse ($room_types as $room_type)
                    <div class="col-lg-8" data-aos="zoom-in">
                      <transition name="slide-fade" mode="out-in">
                        <img src="{{ Storage::url($room_type->photo) }}"
                        {{-- :src="photos[activePhoto].url"
                        :key="photos[activePhoto].id" --}}
                        alt="" style="width: 70%"/>
                      </transition>
                    </div>
                    @empty
                      <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        No Room Type Found
                      </div>
                      @endforelse
                </div>
              </section>
              <div class="store-details-container" data-aos="fade-up">
                <section class="store-heading">
                  <div class="container">
                    <div class="row">
                      @php
                          $incrementRoomTypes = 0
                      @endphp
                      @forelse ($room_types as $room_type)
                      <div class="col-lg-8">
                        <h1>Tipe Kamar</h1>
                        <div class="owner">{{ $room_type->name }}</div>
                        <div class="price">Rp {{ $room_type->price }} / Per Bulan</div>
                        <div class="store-description">
                            <div class="container">
                              <div class="row">
                                <div class="col-12 col-lg-8">
                                  <p>{!! $room_type->description !!}</p>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      @empty
                      <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        No Room Type Found
                      </div>
                      @endforelse
                      <div class="col-lg-4" data-aos="zoom-in">

                        <div class="card-body shadow-lg p-3 mb-5 bg-white rounde">
                            <div class="form-group">
                                <label>Pilih Kamar</label>
                                <select name="room" id="room" class="form-control">
                                    @foreach ($rooms as $room)
                                        <option value={{ $room->name }}>{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date">Pilih tanggal masuk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input type="date" class="form-control" id="datepicker" name="datepicker" placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duration">Durasi Sewa</label>
                                <select name="duration" id="duration" class="form-control">
                                    <option value="1 Bulan">1 Bulan</option>
                                    <option value="6 Bulan">6 Bulan</option>
                                    <option value="1 Tahun">1 Tahun</option>
                                    {{-- @foreach ($transactions as $transaction)
                                        <option value="{{ $transaction->duration }}">{{ $transaction->$duration }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            @auth
                                <button type="button" class="btn btn-success px-4 text-white btn-block mb-3" data-toggle="modal" data-target="#modal-konfirmasi">
                                    Pesan Kamar
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                                    Masuk Untuk Pesan
                                </a>
                            @endauth

                        </div>
                      </div>
                      </div>
                      <div class="row">
                        @php $incrementRoomType = 0 @endphp
                        <div class="col-md-6">
                            <h4>Fasilitas</h4>
                            <p>Fasilitas yang tersedia pada kamar ini</p>
                            @forelse ($facilities as $facility)
                            <div class="card-body">
                                <ul>
                                    <p>{{ $room_type->facilities }}</p>

                                </ul>

                            </div>
                            @empty
                            <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                                No Facility Found
                            </div>
                            @endforelse

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
<script src="{{ url('/js/moment.min.js') }}"></script>
@endpush

</body>
</html>
