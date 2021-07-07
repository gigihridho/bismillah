@extends('layouts.fe')

@section('title')
    Kost Griyo Kenyo
@endsection

@section('content')
{{-- Hero --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="beranda">
    <div class="container-xxl mx-auto p-0  position-relative header-2-2" style="font-family: 'Poppins', sans-serif">
    <div>
        <div class="mx-auto d-flex flex-lg-row flex-column hero">
            <!-- Left Column -->
            <div
                class="left-column d-flex flex-lg-grow-1 flex-column align-items-lg-start text-lg-start align-items-center text-center">
                <h1 class="title-text-big">
                Punya Impian<br class="d-lg-block d-none" />
                Kamar Kost Yang Nyaman
                </h1>
                <p>Kost Griyo Kenyo merupakan kost <strong>putri</strong> yang nyaman dan bersih. Bagi kamu yang ingin mendapat suasana tersebut, Ayo segera miliki kamar di sini.</p>
                <div class="d-flex flex-sm-row flex-column align-items-center mx-lg-0 mx-auto justify-content-center gap-3">
                <a href="#kamar" class="btn d-inline-flex mb-md-0 btn-try text-white">
                    Pesan Kamar
                </a>
                @guest
                <a href="{{ route('register') }}" class="btn btn-outline">
                    <div class="d-flex align-items-center">
                        Daftar
                    </div>
                </a>
                @endguest
                </div>
            </div>
            <!-- Right Column -->
            <div class="right-column text-center d-flex justify-content-center pe-0">
                <img id="img-fluid" class="h-auto mw-100"
                src="{{ asset('fe/img/hero.png') }}"
                alt="" />
            </div>
        </div>
    </div>
    </div>
</section>

{{-- Benefit --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="benefit" data-aos="fade-up">
    <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="d-flex flex-lg-row flex-column align-items-center">
        <!-- Left Column -->
        <div class="img-hero text-center justify-content-center d-flex">
            <img id="hero" class="img-fluid"
            src="{{ asset('fe/img/Home-search.png') }}"
            alt="" />
        </div>

        <!-- Right Column -->
        <div class="right-column d-flex flex-column align-items-lg-start align-items-center text-lg-start text-center">
            <h2 class="title-text">3 Keuntungan Kost di Sini</h2>
            <ul style="padding: 0; margin: 0">
            <li class="list-unstyled" style="margin-bottom: 2rem">
                <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    1
                </span>
                Harga Terjangkau
                </h4>
                <p class="text-caption">
                Dengan harga yang terjangkau<br class="d-sm-inline d-none" />
                sudah bisa merasakan fasilitas yang cukup.
                </p>
            </li>
            <li class="list-unstyled" style="margin-bottom: 2rem">
                <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    2
                </span>
                Lokasi Strategis
                </h4>
                <p class="text-caption">
                Lokasi yang strategis memudahkan kamu untuk<br class="d-sm-inline d-none" />
                mencari makan, kuliah, belanja kebutuhan sehari-hari.
                </p>
            </li>
            <li class="list-unstyled" style="margin-bottom: 4rem">
                <h4
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    3
                </span>
                Suasana nyaman
                </h4>
                <p class="text-caption">
                Meskipun dekat dengan kampus mahasiswa<br class="d-sm-inline d-none" />
                kost ini masih memiliki suasana nyaman.
                </p>
            </li>
            </ul>
        </div>
        </div>
    </div>
</section>

{{-- Room --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="kamar" data-aos="fade-down">
    <div class="content-2-2 container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Pilihan Kamar Kost</h1>
            <p class="text-caption" style="margin-left: 3rem; margin-right: 3rem">
                Setiap kamar kost memiliki harga yang berbeda
            </p>
        </div>

        <div class="grid-padding text-center">
            <div class="row">
                @php $incrementRoomType = 0 @endphp
                @forelse ($room_types as $room_type)
                <div class="col-lg-4 column">
                    <div class="card card-explore">
                    <div class="card-explore__img">
                        <img class="card-img" src="{{ Storage::url($room_type->photo) }}"
                        alt="" />
                    </div>
                    <div class="card-body">
                        <h3 class="room-title">{{ $room_type->name }}</h3>
                        <p class="room-price">Rp {{number_format($room_type->price)}}/bulan</p>
                        <a href="{{ route('detail-kost',$room_type->id) }}" class="btn btn-fill text-white">Pesan Kamar</a>
                    </div>
                    </div>
                </div>
                @empty
                    <p>Tidak ada Kamar</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<section class="h-100 w-100 bg-white" style="box-sizing: border-box" data-aos="fade-up">
    <div class="content-2-2 container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Cara Pembayaran</h1>
            <p class="text-caption" style="margin-left: 3rem; margin-right: 3rem">
                Tata Cara Pembayaran Melalui Website
            </p>
        </div>

        <div class="grid-padding text-center">
        <div class="row">
            <div class="col-lg-4 column">
            <div class="icon">
                <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-5.png"
                alt="" />
            </div>
            <h3 class="icon-title">Registrasi Akun</h3>
            <p class="icon-caption">
                Anda perlu mendaftar<br />
                ke dalam sistem
            </p>
            </div>
            <div class="col-lg-4 column">
            <div class="icon">
                <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-6.png"
                alt="" />
            </div>
            <h3 class="icon-title">Transaksi</h3>
            <p class="icon-caption">
                Anda melakukan pemesanan kamar
            </p>
            </div>
            <div class="col-lg-4 column">
            <div class="icon">
                <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-7.png"
                alt="" />
            </div>
            <h3 class="icon-title">Konfirmasi</h3>
            <p class="icon-caption">
                Pesan anda akan dikonfirmasi Admin<br />
                Anda bisa menempati kamar kost
            </p>
            </div>
        </div>
        </div>
    </div>
</section>

{{-- Review --}}
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="review" data-aos="fade-down">
    <div class="review container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Review Kost</h1>
            <p>Berikut review dari mereka</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($reviews as $r)
                    <div class="item">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="icon-title">{{ $r->user->name }}</h3>
                                <p class="icon-caption">
                                    {{ $r->review }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('after-script')
<script>
    $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
</script>
@endpush
