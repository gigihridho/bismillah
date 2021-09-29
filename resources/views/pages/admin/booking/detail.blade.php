@extends('layouts.admin')

@section('title')
    Detail Transaksi
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin-dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-header">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    Detail Transaksi
                </h4>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 order-md-2 mb-4">
                        <ul class="list-group list-group-flush mb-3">
                            @foreach ($transactions as $index => $transaction)
                            {{-- <div class="row">
                                <div class="col-md-6 mb-3"> --}}
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Status</h6>
                                        </div>
                                        @if($transaction->status == "Menunggu")
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($transaction->status == "Selesai")
                                            <span class="badge badge-success">Selesai</span>
                                        @elseif($transaction->status == "Dibatalkan")
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Kode Pemesanan</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->code }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Nama Lengkap</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->user->name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">E-mail</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->user->email }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Nomor Telepon</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->user->no_hp }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Total Harga</h6>
                                        </div>
                                        <span class="text-muted">Rp{{ number_format($transaction->total_price) }}</span>
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
                                        <span class="text-muted">{{ $transaction->order_date }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Lama Durasi Sewa</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->duration }} bulan</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Tanggal Masuk</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->arrival_date }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Tanggal Keluar</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->departure_date}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">Nomor Kamar</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->room->room_number }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Tipe Kamar</h6>
                                        </div>
                                        <span class="text-muted">{{ $transaction->room->room_type->name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                        <h6 class="my-0">Bukti Transaksi</h6>
                                        </div>
                                        @if($transaction->photo_payment != null)
                                        <img height="100px" src="{{ Storage::url($transaction->photo_payment) }}" alt="" onclick="blank">
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
                <div class="row">
                    <div class="mx- justify-content-left ml-4">
                        <a href="{{ route('transaksi') }}" class="btn btn-info">Kembali</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection
