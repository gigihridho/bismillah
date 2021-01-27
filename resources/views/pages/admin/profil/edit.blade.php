@extends('layouts.admin')

@section('title')
    Profil
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
                    <h4>Profil Admin</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('change-profil-redirect','change-profil') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Admin</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input type="number" name="no_hp"  value="{{ auth()->user()->no_hp }}" class="form-control">
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
