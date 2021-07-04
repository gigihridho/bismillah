@extends('layouts.admin')

@section('title')
    Fasilitas
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

        <div class="section-body" id="facilities_create">
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
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    <div class="card-header">
                        <h4>Tambah Fasilitas</h4>
                    </div>
                    <div class="card-body">
                        <form id="facilities_store" action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Fasilitas</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1"
                                                    @if (old('status') == '1') selected="selected" @endif>Aktif
                                            </option>
                                            <option value="0"
                                                    @if (old('status') == '0') selected="selected" @endif>
                                                Tidak Aktif
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" id="submit" class="btn btn-success px-5 simpan">
                                            Simpan Data
                                        </button>
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
