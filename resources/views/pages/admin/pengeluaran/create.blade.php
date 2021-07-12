@extends('layouts.admin')

@section('title')
    Pengeluaran
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
                        <h4>Tambah Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pengeluaran</label>
                                    <input type="text" name="pengeluaran" class="form-control"
                                    placeholder="Masukkan Jenis Pengeluaran" value="{{ old('pengeluaran') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nominal</label>
                                    <input type="number" name="nominal" class="form-control"
                                    placeholder="10000" value="{{ old('nominal') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1"
                                            @if (old('status') == '1')selected="selected" @endif" >
                                            Lunas
                                        </option>
                                        <option value="0" s
                                            @if (old('status') == '0')selected="selected" @endif" >
                                            Belum Lunas
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control"
                                    placeholder="Masukkan keterangan pengeluaran" value="{{ old('keterangan') }}">
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
