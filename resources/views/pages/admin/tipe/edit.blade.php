@extends('layouts.admin')

@section('title')
    Edit Tipe Kamar
@endsection

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Table @yield('title')</h1>
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
                    <h4>Tambah Tipe Kamar</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('tipe.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tipe Kamar</label>
                                    <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="photo" value="{{ $data->photo }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="price" value="{{ $data->price }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Luas</label>
                                    <input type="text" name="size" value="{{ $data->size }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success px-5">
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
