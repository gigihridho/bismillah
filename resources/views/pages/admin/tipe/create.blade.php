@extends('layouts.admin')

@section('title')
    Tipe Kamar
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
                        <h4>Tambah Tipe Kamar</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tipe.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipe Kamar</label>
                                        <input type="text" name="name" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lantai</label>
                                        <input type="number" name="floor" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" name="price" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Luas</label>
                                        <input type="text" name="size" class="form-control" autocomplete="off">
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
                                <div class="col-md-6">
                                    <h6>Fasilitas</h6>
                                    <div class="form-group mt-2">
                                    @forelse($facilities as $facility)
                                        <div class="form-check">
                                            <label class="checkbox" name="facility">
                                                <input name="facility[{{$facility->id}}]" value={{ $facility->name }} class="form-check-input" type="checkbox" data-toggle="checkbox" id="defaultCheck1" >
                                                {{ $facility->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>Maaf tidak ada fasilitas tersedia</p>
                                    @endforelse
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
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
