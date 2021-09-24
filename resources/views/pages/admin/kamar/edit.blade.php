@extends('layouts.admin')

@section('title')
    Kamar
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit @yield('title')</h1>
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
                        <h4>Edit Kamar</h4>
                    </div>
                    <div class="card-body">
                        <form action="/admin/tipe/{{ $room_type->id }}/kamar/{{ $room->id }}/edit" method="POST" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nomor Kamar</label>
                                        <input type="text" name="room_number" value="{{ $room->room_number }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tipe Kamar</label>
                                        <select name="room_type_id" class="form-control">
                                            <option value="{{ $room_type->room_type_id }}">{{ $room_type->name }}</option>
                                            {{-- @foreach ($room_type as $r)
                                                <option value="{{ $r->id }}">
                                                    {{ $room_type->name }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ketersediaan</label>
                                        <select name="available" id="available" class="form-control">
                                            <option value="1"
                                            @if (old('availabe') == '1')selected="selected" @endif" >
                                            Tersedia
                                            </option>
                                            <option value="0"
                                                @if (old('available') == '0')selected="selected" @endif" >
                                            Tidak Tersedia
                                        </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1"
                                            @if (old('status') == '1')selected="selected" @endif" >
                                            Aktif
                                            </option>
                                            <option value="0"
                                                @if (old('status') == '0')selected="selected" @endif" >
                                            Tidak Aktif
                                        </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary px-5" style="padding: 8px 16px">
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
