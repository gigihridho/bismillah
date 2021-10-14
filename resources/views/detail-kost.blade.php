@extends('layouts.fe')

@section('title')
    Detail Kamar
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.min.css" integrity="sha512-9h7XRlUeUwcHUf9bNiWSTO9ovOWFELxTlViP801e5BbwNJ5ir9ua6L20tEroWZdm+HFBAWBLx2qH4l4QHHlRyg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css" integrity="sha512-+0Vhbu8sRUlg+R/NKgTv7ahM+szPDF10G6J5PcHb1tOrAaquZIUiKUV3TH16mi6fuH4NjvHqlok6ppBhR6Nxuw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
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
.r1 {
    border-right: 1px solid #d1d1d1;
}
.facility {
    /*width: 30%;*/
    float: left;
    /* padding: 10px; */
}
</style>
<section class="h-100 w-100 bg-white pb-5" style="box-sizing: border-box">
    <div class="detail-1 container mx-auto p-0  position-relative detail-content" style="font-family: 'Poppins', sans-serif">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </nav>
        </div>

        <div class="kost-gallery mt-3" id="gallery">
            <div class="container">
                <div class="row">
                    @php $incrementTipeKamar = 0 @endphp
                    @forelse ($tipe_kamars as $tipe_kamar)
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{Storage::url($tipe_kamar->foto) }}" alt="" height="80%" width="90%">
                    </div>
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        Tipe Kamar Tidak Ditemukan
                    </div>
                    @endforelse
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body shadow-lg p-3 mb-5 bg-white rounded">
                            <form action="{{ route('confirmation',$tipe_kamar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input name="booking_validation" type="hidden" value="0">
                            <div class="form-group" style="margin-bottom: 1rem">
                                <label for="date" style="margin-bottom: 0.5rem">Pilih tanggal masuk</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    </div>
                                        <input type="text" data-provide="datepicker" class="form-control" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal Masuk" value="" readonly="">
                                </div>
                                @if ($errors->has('tanggal_masuk'))
                                    @foreach ($errors->get('tanggal_masuk') as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="durasi" style="margin-bottom: 0.5rem">Durasi Sewa</label>
                                <select name="durasi" id="durasi" class="form-select">
                                    <option value="1">1 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">1 Tahun</option>
                                </select>
                                @error('durasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <br>
                            {{-- @if($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                            @endif --}}
                            <br>
                            @auth
                            <button type="submit" class="btn btn-fill px-5 text-white btn-block mb-3" style="width: 100%">
                                Pesan Kamar
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn btn-danger px-5 text-white btn-block mb-3" style="width: 100%; border-radius: 12px;
                            padding: 12px 28px;">
                                Masuk Untuk Pesan
                            </a>
                            @endauth
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kost-detail mb-4" data-aos="fade-up" data-aos-delay="100">
            <section class="kost-heading">
                <div class="container">
                    <div class="row">
                        @php
                        $incrementRoomTypes = 0
                        @endphp
                        @forelse ($tipe_kamars as $tipe_kamar)
                        <div class="col-lg-4">
                            <h5>Tipe Kamar</h5>
                                <input type="hidden" name="id" value="{{ $tipe_kamar->kamar }}">
                                <div class="owner" style="margin-bottom: 0.5rem">{{ $tipe_kamar->nama }}</div>
                                <div class="owner" style="margin-bottom: 0.5rem">Lantai {{ $tipe_kamar->lantai }}</div>
                                <div class="price" style="color: red">Rp {{ number_format($tipe_kamar->harga) }}/Bulan</div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            Tipe Kamar Tidak Ditemukan
                        </div>
                        @endforelse
                        <hr style="margin-top:20px">
                        <h4 style="margin-top:10px">Fasilitas</h4>
                        @foreach ($tipe_kamar->fasilitas->chunk(2) as $facilityy)
                            @php $incrementRoomType = 0 @endphp
                            @forelse ($facilityy as $facility)
                            <div class="facility col-lg-4" style="padding:auto;">
                                <p>{{ $facility->nama }}</p>
                            </div>
                            @empty
                            <div class="col-12 text-left">
                                Tida ada fasilitas
                            </div>
                            @endforelse
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

{{-- Cek Profil --}}
@if(Auth::check() && !Auth::user()->foto_ktp)
<div id="myModal" class="modal fade hide fade in" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: red">Data diri belum lengkap</h5>
            </div>
            <div class="modal-body">
                <p>Untuk melakukan pemesanan kamar, Anda perlu melengkapi data diri terlebih dahulu. <br>
                    Silakan lengkapi data diri anda pada halaman profil.
                </p>
            </div>
            <div class="modal-footer">
                <a href={{ route('profil-user') }} class="btn btn-danger">Buka Profil</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@push('after-script')
<script>
    $('#myModal').modal('show');

    $(function () {
    var $dp1 = $("#tanggal_masuk");
    $(document).ready(function () {

    $dp1.datepicker({
    changeYear: true,
    changeMonth: true,
        minDate: '0',
        maxDate: '2m',
    dateFormat: "yy-mm-dd",
    yearRange: "-100:+20",
    });
    });
});
</script>
@endpush
