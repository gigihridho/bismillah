@extends('layouts.fe')

@section('title')
    Detail Kamar
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.min.css" integrity="sha512-9h7XRlUeUwcHUf9bNiWSTO9ovOWFELxTlViP801e5BbwNJ5ir9ua6L20tEroWZdm+HFBAWBLx2qH4l4QHHlRyg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css" integrity="sha512-+0Vhbu8sRUlg+R/NKgTv7ahM+szPDF10G6J5PcHb1tOrAaquZIUiKUV3TH16mi6fuH4NjvHqlok6ppBhR6Nxuw==" crossorigin="anonymous" referrerpolicy="no-referrer" /><style>
.btn-fill{
    background-color: #6777ef;
    border-radius: 12px;
    padding: 12px 28px;
    transition: 0.3s;
}
p.pfield-wrapper input {
  float: right;
}
p.pfield-wrapper::after {
  content: "\00a0\00a0 "; /* keeps spacing consistent */
  float: right;
}
p.required-field::after {
  content: "*";
  float: right;
  margin-left: -3%;
  color: red;
}
</style>
<section class="h-100 w-100 bg-white" style="box-sizing: border-box">
    <div class="detail-1 container mx-auto p-0  position-relative detail-content" style="font-family: 'Poppins', sans-serif">
        <div class="row">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </nav>
        </div>

        <div class="kost-gallery" id="gallery">
            <div class="container">
                <div class="row">
                    @php $incrementRoomType = 0 @endphp
                    @forelse ($room_types as $room_type)
                    <div class="col-lg-8" style="margin-bottom: 1rem">
                        <img src="{{Storage::url($room_type->photo) }}" alt="" width="100%">
                    </div>
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        Tipe Kamar Tidak Ditemukan
                    </div>
                    @endforelse
                    <div class="col-lg-4">
                        <div class="card-body shadow-lg p-3 mb-5 bg-white rounded">
                            <form action="{{ route('confirmation',$room_type->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="booking_validation" type="hidden" value="0">
                            <div class="form-group" style="margin-bottom: 1rem">
                                <label for="date" style="margin-bottom: 0.5rem">Pilih tanggal masuk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
                                        <input type="text" data-provide="datepicker" class="form-control" id="arrival_date" name="arrival_date" placeholder="Tanggal Masuk" value="" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duration" style="margin-bottom: 0.5rem">Durasi Sewa</label>
                                <select name="duration" id="duration" class="form-control">
                                    <option value="1">1 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">1 Tahun</option>
                                </select>
                            </div>
                            <br>
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                            @endif
                            <br>
                            @auth
                            <button type="submit" class="btn btn-fill px-5 text-white btn-block mb-3" style="width: 100%">
                                Pesan Kamar
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-fill text-white btn-block mb-3" style="width: 100%">
                                Masuk Untuk Pesan
                            </a>
                            @endauth
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kost-detail">
            <section class="kost-heading">
                <div class="container">
                    <div class="row">
                        @php
                        $incrementRoomTypes = 0
                        @endphp
                        @forelse ($room_types as $room_type)
                        <div class="col-lg-8">
                            <h4>Tipe Kamar</h4>
                            <input type="hidden" name="id" value="{{ $room_type->room }}">
                            <div class="owner" style="margin-bottom: 0.5rem">{{ $room_type->name }}</div>
                            <div class="price" style="color: red">Rp {{ number_format($room_type->price) }}/Bulan</div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            Tipe Kamar Tidak Ditemukan
                        </div>
                        @endforelse
                    </div>
                    <hr>
                    <div class="row">
                        @php $incrementRoomType = 0 @endphp
                        <div class="col-md-6">
                            <h5>Fasilitas</h5>
                            @forelse ($room_type->facilities as $facility)
                                <p>{{ $facility->name }}</p>
                            @empty
                            <div class="col-12 text-left" data-aos="fade-up" data-aos-delay="100">
                                Data Fasilitas Tidak Ditemukan
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection
@push('after-script')
<script>
    $(function () {
    var $dp1 = $("#arrival_date");
      $(document).ready(function () {

      $dp1.datepicker({
        changeYear: true,
        changeMonth: true,
            minDate: '0',
        dateFormat: "yy-mm-dd",
        yearRange: "-100:+20",
      });
     });
});
</script>
@endpush
