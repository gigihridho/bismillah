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
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Kamar</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak Terseidia">Tidak Tersedia</option>
                                </select>
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
                    </div>
                  </form>
                </div>
              </div>
          </div>
      </div>
    </section>
  </div>
@endsection
@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
@endpush
