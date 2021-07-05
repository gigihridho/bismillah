@extends('layouts.fe')

@section('title')
    Kost Griyo Kenyo
@endsection

@section('content')
<section class="h1-00 w-100 bg-white" style="box-sizing: border-box">
    <div class="content-3-2 container-xxl mx-auto  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="d-flex flex-lg-row flex-column align-items-center">
        <!-- Left Column -->
        <div class="img-hero text-center justify-content-center d-flex">
            <img id="hero" class="img-fluid"
            src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content3/Content-3-1.png"
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
<section class="h-100 w-100 bg-white" style="box-sizing: border-box">
    <div class="content-2-2 container-xxl mx-auto p-0  position-relative" style="font-family: 'Poppins', sans-serif">
        <div class="text-center title-text">
            <h1 class="text-title">Pilihan Kamar Kost</h1>
            <p class="text-caption" style="margin-left: 3rem; margin-right: 3rem">
                Setiap kamar kost memiliki harga yang berbeda
            </p>
            </div>

            <div class="grid-padding text-center">
            <div class="row">
                <div class="col-lg-4 column">
                <div class="icon">
                    <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-5.png"
                    alt="" />
                </div>
                <h3 class="icon-title">Easy to Operate</h3>
                <p class="icon-caption">
                    This can easily help you to<br />
                    grow up your business fast
                </p>
                </div>
                <div class="col-lg-4 column">
                <div class="icon">
                    <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-6.png"
                    alt="" />
                </div>
                <h3 class="icon-title">Real-Time Analytic</h3>
                <p class="icon-caption">
                    With real-time analytics, you<br />
                    can check data in real time
                </p>
                </div>
                <div class="col-lg-4 column">
                <div class="icon">
                    <img src="http://api.elements.buildwithangga.com/storage/files/2/assets/Content/Content2/Content-2-7.png"
                    alt="" />
                </div>
                <h3 class="icon-title">Very Full Secured</h3>
                <p class="icon-caption">
                    With real-time analytics, we<br />
                    will guarantee your data
                </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
