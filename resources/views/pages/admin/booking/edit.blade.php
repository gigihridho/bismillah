@extends('layouts.admin')

@section('title')
    Update Status Booking
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Table @yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="card-header">
                        <h4>Update Status Booking</h4>
                    </div>
                    <div class="card-body">
                        <form action="/admin/booking/{{$room_booking->id}}/edit" method="POST" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Menunggu"
                                            @if ($room_booking->status == 'Menunggu')
                                                selected="selected"
                                            @endif>Menunggu
                                            </option>
                                            <option value="Terisi"
                                            @if ($room_booking->status == 'Terisi')
                                                selected="selected"
                                            @endif>Terisi
                                            </option>
                                            <option value="Keluar"
                                            @if ($room_booking->status == 'Keluar')
                                                selected="selected"
                                            @endif>Keluar
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pembayaran</label>
                                        <select name="payment" id="payment" class="form-control">
                                            <option value="1"
                                                    @if ($room_booking->payment == '1') selected="selected" @endif>Terbayar
                                            </option>
                                            <option value="0"
                                                    @if ($room_booking->payment == '0') selected="selected" @endif>
                                                Belum Terbayar
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5" style="padding: 8px 16px">
                                        Update Status
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
