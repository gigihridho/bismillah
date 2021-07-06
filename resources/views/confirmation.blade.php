@extends('layouts.fe')

@section('title')
    Pengajuan Sewa
@endsection

@section('content')

<section class="h-100 w-100 bg-white pb-5" style="box-sizing: border-box">
    <div class="confirmation container mx-auto p-0  position-relative confirmation-content"
        style="font-family: 'Poppins', sans-serif">
        <div class="row">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </nav>
        </div>

        <div class="container-fluid">
            <div class="row" style="margin-bottom:1rem;">
                <h3>Pengajuan Sewa</h3>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card" style="width: 100%;">
                        <img src="{{ Storage::url($room_type->photo) }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Tipe Kamar {{ $room_type->name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Detail Pesanan</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                            <h6 class="my-0">Nama Lengkap</h6>
                            </div>
                            <span class="text-muted">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                            <h6 class="my-0">E-mail</h6>
                            </div>
                            <span class="text-muted">{{ Auth::user()->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                            <h6 class="my-0">Nomor Telepon</h6>
                            </div>
                            <span class="text-muted">{{ Auth::user()->no_hp }}</span>
                        </li>
                    </ul>

                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                            <h6 class="my-0">Tanggal Masuk</h6>
                            </div>
                            <span class="text-muted">{{ $new_arrival_date }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                            <h6 class="my-0">Tanggal Keluar</h6>
                            </div>
                            <span class="text-muted">{{ $new_departure_date}}</span>
                        </li>
                    </ul>

                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Nomor Kamar</h6>
                            </div>
                            <span class="text-muted">{{ $room_number }}</span>
                            </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                            <h6 class="my-0">Tipe Kamar</h6>
                            </div>
                            <span class="text-muted">{{ $room_type->name }}</span>
                        </li>
                    </ul>

                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Total</span>
                    </h4>

                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $duration }} Bulan</h6>
                            </div>
                            <span class="text-muted">Rp. {{ $total_price }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-betweeb lh-condensed">
                            <h6>Rekening Tujuan</h6>
                                <h6 class="text-muted" style="margin-left: auto">08164282</h6>
                        </li>
                    </ul>

                    <form class="card p-2" action="{{ route('booking', $room_type_id) }}" method="post">
                        @csrf
                            <input name="booking_validation" type="hidden" value="0">
                            <input type="date" class="form-control" id="datepicker" name="arrival_date" value="{{ $new_arrival_date }}" hidden>
                            <input name="duration" id="duration" class="form-control" value="{{ $duration }}" hidden>
                            <button type="submit" class="btn btn-success">Pesan</button>
                    </form>
                </div>
            </div>
</section>
@endsection
