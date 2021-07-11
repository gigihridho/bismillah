@extends('layouts.user')

@section('title')
    Profil User
@endsection

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/viewProfil.css') }}" type="text/css">
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
                @php $no = 1; @endphp
                @foreach ($data as $u)
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <div class="card1">
                                <div class="card-body">
                                    <i class="fas fa-user mr-2"></i> Foto KTP
                                    <hr>
                                    <div class="image">
                                        @if ($u->photo_ktp != null)
                                            <img src="{{ Storage::url($u->photo_ktp) }}" alt="foto"
                                            style="display: block; margin-left:auto;  margin:auto">
                                        @else
                                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="250px" height="250px" alt="foto"
                                            style="display: block; margin:auto">
                                        @endif
                                    </div>
                                    <br>
                                        <div>
                                            <a href="{{route('change-profil-user')}}" class="btn btn-info px-5">Ubah Profil</a>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="w-100 table-responsive">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <br>
                                                    Nama
                                                    <input type="text" name="name" value="{{ $u->name }}" class="form-control" style="margin-right:190px; backgroud-color:white; border: none" disabled>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <br>
                                                    Email
                                                    <input type="email" name="email" value="{{ $u->email }}" class="form-control" style="border: none" disabled>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <br>
                                                    No Telepon
                                                    <input type="number" name="no_hp" value="{{ $u->no_hp }}" class="form-control" style="border: none" disabled>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <br>
                                                    Alamat
                                                    <input type="text" name="address" value="{{ $u->address }}"class="form-control" style="border: none" disabled>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <br>
                                                    Pekerjaan
                                                    <input type="text" name="profession" value="{{ $u->profession }}" class="form-control" style="border: none" disabled>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
