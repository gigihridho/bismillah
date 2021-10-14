@extends('layouts.admin')

@section('title')
    Edit Tipe Kamar
@endsection

@section('content')
<style type="text/css">
.required:after {
    content:" *";
    color: red;
}
@media (max-width: 427px) {
    .tombol .btn.simpan {
        margin-bottom: 10px;
    }
}
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
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
                        <h4>Edit Tipe Kamar</h4>
                    </div>
                    @foreach ($data as $d)
                    <div class="card-body">
                        <form action="{{ route('tipe.update', $d->id ) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Tipe Kamar</label>
                                        <input type="text" name="nama" value="{{ $d->nama }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Lantai</label>
                                        <input type="number" name="lantai" value="{{ $d->lantai }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Harga</label>
                                        <input type="number" name="harga" value="{{ $d->harga }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Ukuran</label>
                                        <input type="text" name="ukuran" value="{{ $d->ukuran }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="d-block required">Fasilitas</label>
                                    @forelse ($fasilitas as $fas)
                                        <div class="form-check mb-3">
                                            <label class="checkbox">
                                                <input name="fas[{{ $fas->id }}]" class="form-check-input" type="checkbox" value="{{ $fas->nama }}"
                                                @if ($d->fasilitas->contains($fas->id)) checked @endif>{{ $fas->nama }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>Maaf, Tidak ada fasilitas tersedia</p>
                                    @endforelse
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="required">Foto</label>
                                        <input type="file" id="input_photo" name="photo" class="form-control">
                                    </div>
                                    @if ($d->foto != null)
                                        <img id="img_photo" src="{{ Storage::url($d->foto) }}" width="280px" height="180px" alt="foto"
                                        style="display: block; margin:auto">
                                    @else
                                        <img id="img_photo" src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="170px" height="170px" alt="foto"
                                        style="display: block; margin:auto">
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row tombol">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5 simpan" style="padding: 8px 16px">
                                        Simpan Data
                                    </button>
                                    <a href="{{ route('tipe.index') }}" class="btn btn-danger px-5" style="padding: 8px 16px; margin-left:10px;">
                                        Batal
                                    </a>
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
@push('addon-script')
<script type="text/javascript">
    $(function () {
        $("#input_photo").change(function () {
            readURL(this);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
