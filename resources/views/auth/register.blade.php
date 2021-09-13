@extends('layouts.fe')

@section('content')
<style>
      .form-group{
        margin-bottom: 25px;
    }
    .card .card-header h4 {
        font-size: 16px;
        line-height: 28px;
        color: #6777ef;
        padding-right: 10px;
        margin-bottom: 0;
    }

    .text-small{
        font-size: 12px;
        line-height: 20px;
    }
    a{
        color: #6777ef;
        font-weight: 500;
        -webkit-transition: all 0.5s
    }
    .btn:not(:disabled):not(.disabled){
        cursor: pointer;
    }

    .btn.btn-lg{
        padding: .75rem 1.5rem;
        font-size: 12px;
    }
    .btn-primary, .btn-primary.disabled {
    box-shadow: 0 2px 6px #acb5f6;
    background-color: #6777ef;
    border-color: #6777ef;
}
.btn {
    font-weight: 600;
    font-size: 12px;
    line-height: 30px;
    padding: 5rem 3rem;
    letter-spacing: 0.5px;
}
    .btn-block{
        display: block;
        width: 100%;
    }
    .btn-group-lg>.btn, .btn-lg {
    padding: .5rem 1rem;
    font-size: 1.25rem;
    line-height: 1.5;
    border-radius: .3rem;
}
.btn-primary {
    color: #fff;
    background-color: #6777ef;
    border-color: #6777ef;
}
#small {
  font-size: 12px;
  line-height: 20px; }

</style>
<div id="app" style="background: #F2F6FF">
    <section class="section">
        <div class="container">
            <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="card card-primary">
                <div class="card-header justify-content-center"><h4>Daftar Akun</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus placeholder="Masukkan Nama Anda"
                                oninvalid="this.setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Masukkan Email Anda"
                                oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password"class="d-block">Kata Sandi</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off" placeholder="Masukkan Kata Sandi Anda"
                                oninvalid="this.setCustomValidity('Kata sandi tidak boleh kosong')" oninput="setCustomValidity('')">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="password-confirm"class="d-block">Konfirmasi Kata Sandi</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off"
                                placeholder="Masukkan Kata Sandi Anda Lagi"
                                oninvalid="this.setCustomValidity('Kata sandi tidak boleh kosong')" oninput="setCustomValidity('')">

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small style="font-size: 12px;">Keterangan : Pastikan sama dengan kata sandi sebelumnya</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="address">Alamat Asal</label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="off" placeholder="Masukkan Alamat Asal Anda"
                                oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="profession">Pekerjaan</label>
                                <input id="profession" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{ old('profession') }}" required autocomplete="off" placeholder="Masukkan Pekerjaan Anda" oninvalid="this.setCustomValidity('Pekerjaan tidak boleh kosong')" oninput="setCustomValidity('')">

                                @error('profession')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="no_hp">No Telepon</label>
                                <input id="no_hp" type="numeric" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="off" placeholder="Masukkan Nomor Telepon Anda"
                                oninvalid="this.setCustomValidity('Nomor telepon tidak boleh kosong')" oninput="setCustomValidity('')">

                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <small style="font-size: 12px;">Contoh: 08190211313</small>
                            </div>
                            <div class="form-group col-6">
                                <label for="photo_ktp" class="control-label">Foto KTP</label>
                                <input id="photo_ktp" type="file" class="form-control @error('photo_ktp') is-invalid @enderror"
                                name="photo_ktp" required autofocus oninvalid="this.setCustomValidity('Foto KTP tidak boleh kosong')" oninput="setCustomValidity('')">

                                    @error('photo_ktp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                <small style="font-size: 12px;">Format: jpeg,jpg,png. Ukuran Maksimal: 2MB</small>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                {{ __('Daftar') }}
                            </button>
                        </div>
                    </form>
                    <div class="text-center">
                        Sudah Punya Akun? <a href="{{ route('login') }}" style="color:#6777ef">Masuk</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection
