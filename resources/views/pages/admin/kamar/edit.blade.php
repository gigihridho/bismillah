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
                    <h4>Edit Data Kamar</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('kamar.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Kamar</label>
                                    <input type="text" name="name" value="{{ $item->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tipe Kamar</label>
                                    <select name="room_type_id" class="form-control">
                                        <option value="{{ $item->room_type_id }}">{{ $item->room_type->name }}</option>
                                        @foreach ($room_types as $room_type)
                                            <option value="{{ $room_type->id }}">
                                                {{ $room_type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="{{ $item->status }}" selected>Tidak diganti</option>
                                        <option value="Tersedia">Tersedia</>
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
                </div>
              </div>
          </div>
      </div>
    </section>
  </div>
@endsection
