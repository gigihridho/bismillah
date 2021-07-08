@extends('layouts.admin')

@section('title')
    Kamar
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <div class="card">
                    <div class="card-header">
                        <h4>Tambah Kamar</h4>
                    </div>
                    <div class="card-body">
                        <form action="/admin/tipe/{{ $room_type->id }}/kamar" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Kamar</label>
                                    <input type="text" name="room_number" class="form-control"
                                    placeholder="" value="{{ old('room_number') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1"
                                            @if (old('status') == '1')selected="selected" @endif" >
                                            Aktif
                                        </option>
                                        <option value="0" s
                                            @if (old('status') == '0')selected="selected" @endif" >
                                            Tidak Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success px-5" style="padding: 8px 16px">
                                        Simpan Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
