@extends('layouts.admin')

@section('title')
    Booking
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin-dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-header">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    Detail Sewa
                </h4>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 order-md-2 mb-4">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach ($room_bookings as $index => $room_booking)
                            {{-- <div class="row">
                                <div class="col-md-6 mb-3"> --}}
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Status</h6>
                                        </div>
                                        @if($room_booking->status == "Menunggu")
                                        <span class="badge badge-waring">Menunggu</span>
                                        @elseif($room_booking->status == "Terisi")
                                        <span class="badge badge-success">Terisi</span>
                                        @elseif($room_booking->status == "Keluar")
                                        <span class="badge badge-danger">Keluar</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Keterangan</h6>
                                        </div>
                                        @if($room_booking->payment == 1)
                                        <span class="badge badge-success">Sudah Bayar</span>
                                        @else
                                            <span class="badge badge-danger">Belum Bayar</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Kode Pemesanan</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->kode }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Nama Lengkap</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->user->name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">E-mail</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->user->email }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Nomor Telepon</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->user->no_hp }}</span>
                                    </li>
                                {{-- </div>
                            </div> --}}
                        </ul>
                    </div>
                    <div class="col-md-6 order-md-2 mb-4">
                        <ul class="list-group list-group-flush mb-3">
                            {{-- <div class="row">
                                <div class="col-md-6 mb-3"> --}}
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Tanggal Pesan</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->order_date }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Tanggal Masuk</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->arrival_date }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Tanggal Keluar</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->departure_date}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Nomor Kamar</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->room->room_number }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Tipe Kamar</h6>
                                        </div>
                                        <span class="text-muted">{{ $room_booking->room->room_type->name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Bukti Transaksi</h6>
                                        </div>
                                        @if($room_booking->photo_payment != null)
                                        <img height="100px" src="{{ Storage::url($room_booking->photo_payment) }}" alt="" onclick="blank">
                                        @else
                                            <button class="btn btn-warning btn-sm" style="text-align:center">Belum Upload
                                            </button>
                                        @endif
                                    </li>
                                {{-- </div>
                            </div> --}}
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection
