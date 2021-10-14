@extends('layouts.admin')

@section('title')
    User
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Detail @yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($user as $u)
                            <form>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <h5>Detail User</h5>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="name" class="col-3 col-form-label">Nama</label>
                                    <div class="col-9">
                                    <input id="name" name="name" value="{{ $u->name }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-3 col-form-label">Nomor Handphone</label>
                                    <div class="col-9">
                                    <input id="lastname" name="no_hp" value="{{ $u->no_hp }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Alamat</label>
                                    <div class="col-9">
                                    <input id="text" name="alamat" value="{{ $u->alamat }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Pekerjaan</label>
                                    <div class="col-9">
                                    <input id="text" name="pekerjaan" value="{{ $u->pekerjaan }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Bank</label>
                                    <div class="col-9">
                                    <input id="text" name="bank" value="{{ $u->bank }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Nomor Rekening</label>
                                    <div class="col-9">
                                    <input id="text" name="no_rekening" value="{{ $u->no_rekening }}" class="form-control here" type="text" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-3 col-form-label">Foto KTP</label>
                                    <div class="col-9">
                                        @if ($u->foto_ktp == null)
                                        <div class="image-preview" id="imagePreview">
                                            <img src="" alt="Image Preview" class="image-preview__image">
                                                <span class="image-preview__default-text">
                                                +</span>
                                        </div>
                                        @else
                                            <img id="img_ktp" src="{{ Storage::url($u->foto_ktp) }}" name="foto_ktp" width="250px" height="200px" alt="foto"
                                            style="display: block; margin-bottom:15px; margin-right:auto">
                                        @endif
                                    </div>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
