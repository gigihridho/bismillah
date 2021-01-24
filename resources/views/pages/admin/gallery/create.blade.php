@extends('layouts.admin')

@section('title')
    Tambah Galeri Kamar
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
                  <div class="card-header">
                    <h4>Tambah Galeri Kamar</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Nama Kamar</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Foto Kamar</label>
                        <input type="file" class="form-control">
                      </div>
                    <div class="row">
                        <div class="col text-right">
                            <button type="submit" class="btn btn-success px-5">
                                Save Now
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
