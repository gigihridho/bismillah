@extends('layouts.dashboard')

@section('title')
    Ubah Kata Sandi
@endsection

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>@yield('title')</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Settings</a></div>
          <div class="breadcrumb-item">@yield('title')</div>
        </div>
      </div>
    <div class="container mt-6">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="card card-primary">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <div class="card-body">
              <form method="POST">
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                        <input id="current_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                        <input id="new_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    {{ __('Reset Password') }}
                  </button>
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
