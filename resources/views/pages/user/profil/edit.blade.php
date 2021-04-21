@extends('layouts.user')

@section('title')
    User Profil
@endsection

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>@yield('title')</h1>
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
                    <h4>Profil User</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ route('change-profil-user-redirect','change-profil-user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Telepon</label>
                            <input type="text" name="no_hp" id="no_hp" value="{{ $user->no_hp }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Foto KTP</label>
                            <input type="file" name="photo_ktp" value="{{ $user->photo_ktp }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" name="address" id="address" value="{{ $user->address }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="profession">Profesi</label>
                            <input type="text" name="profession" id="profession" value="{{ $user->profession }}" class="form-control" required>
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
