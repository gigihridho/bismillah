@extends('layouts.fe')

@section('title')
    Kost Griyo Kenyo
@endsection

@section('content')
<section class="h-100 w-100 bg-white" style="box-sizing: border-box">
    <div class="detail-1 container mx-auto p-0  position-relative detail-content" style="font-family: 'Poppins', sans-serif">
        <div class="row">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
        </div>


    <div class="kost-gallery" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <img src="{{ asset('fe/img/kamar1.png') }}" alt="" width="70%">
                </div>
                <div class="col-lg-4">
                    <div class="card-body shadow-lg p-3 mb-5 bg-white rounde">
                        <form action="#" method="POST" enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <input name="booking_validation" type="hidden" value="0">
                        <div class="form-group">
                            <label for="date">Pilih tanggal masuk</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                    <input type="date" class="form-control" id="datepicker" name="arrival_date" placeholder="DD/MM/YYYY">
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
                        <br>
                        <br>
                        {{-- @auth --}}
                        <button type="submit" class="btn btn-success px-5 text-white btn-block mb-3">
                            Pesan Kamar
                        </button>
                        {{-- @else
                        <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                            Masuk Untuk Pesan
                        </a>
                        @endauth --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="kost-detail">
        <section class="kost-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h4>Tipe Kamar</h4>
                        <input type="hidden" name="id" value="1">
                        <div class="owner">Agus</div>
                        <div class="price">Rp 19.000 / Per Bulan</div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Fasilitas</h5>
                        <p>Fasilitas yang tersedia</p>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
</div>
</section>
@endsection
