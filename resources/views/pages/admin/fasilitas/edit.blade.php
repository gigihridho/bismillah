{{-- @extends('layouts.admin')

@section('title')
    Fasilitas
@endsection

@section('content')

<style type="text/css">
    @media (max-width: 417px) {
            .tombol .btn.simpan {
            margin-bottom: 10px;
            }
        }
</style>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit @yield('title')</h1>
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
                        <h4>Edit Fasilitas</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('fasilitas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf

                        <div class="row tombol">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                    Simpan Data
                                </button>
                                <a href="{{ route('fasilitas.index') }}" class="btn btn-danger px-5" style="padding: 8px 16px">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection --}}
<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="id" value={{ $fas->id }} id="id_fasilitas">
        <div class="form-group">
            <label>Nama Fasilitas</label>
            <input type="text" name="nama" value="{{ $fas->nama }}" class="form-control @error('nama') is-invalid @enderror" autocomplete="off">
            @error('nama')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
</div>
