@extends('layouts.admin')

@section('title')
    Edit Tipe Kamar
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
                        <h4>Tambah Tipe Kamar</h4>
                    </div>
                    @foreach ($data as $d)
                    <div class="card-body">
                        <form action="{{ route('tipe.update', $d->id ) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipe Kamar</label>
                                        <input type="text" name="name" value="{{ $d->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lantai</label>
                                        <input type="number" name="floor" value="{{ $d->floor }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" name="price" value="{{ $d->price }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Luas</label>
                                        <input type="text" name="size" value="{{ $d->size }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1"
                                                @if (old('status') == '1')selected="selected" @endif" >
                                                Aktif
                                            </option>
                                            <option value="0"
                                                @if (old('status') == '0')selected="selected" @endif" >
                                                Tidak Aktif
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label class="d-block">Fasilitas</label>
                                    @forelse ($facilities as $facility)
                                        <div class="form-check mb-3">
                                            <label class="checkbox">
                                                <input name="facility[{{ $facility->id }}]" class="form-check-input" type="checkbox" value="{{ $facility->name }}"
                                                @if ($d->facilities->contains($facility->id)) checked @endif>{{ $facility->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p>Maaf, Tidak ada fasilitas tersedia</p>
                                    @endforelse
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        <input type="file" id="input_photo" name="photo" class="form-control">
                                    </div>
                                    @if ($d->photo != null)
                                        <img id="img_photo" src="{{ Storage::url($d->photo) }}" width="280px" height="180px" alt="foto"
                                        style="display: block; margin:auto">
                                    @else
                                        <img id="img_photo" src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="170px" height="170px" alt="foto"
                                        style="display: block; margin:auto">
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-success px-5" style="padding: 8px 16px">
                                        Simpan Data
                                    </button>
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
