@extends('layouts.user')

@section('title')
    User Booking
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
                    <div class="card-body">
                        {{-- <a href="{{ route('user-transaksi.create') }}" class="btn btn-sm btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Transaksi</a> --}}
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-1">
                            <p>Pilih tombol <button class="btn btn-success"> <i class="fas fa-upload"></i></button> pada kolom Aksi untuk Upload Bukti Pembayaran </p>
                            <thead>
                                <tr style="text-align: center">
                                    <th>
                                    No
                                    </th>
                                    <th>Kamar</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Total Harga</th>
                                    <th>Foto Pembayaran</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $index => $tf)
                                <tr style="text-align: center">
                                    <td>{{ $index+1 }}</td>
                                    <td><button class="btn btn-info btn-sm">{{ $tf->room->room_type->name }} ({{ $tf->room->room_number }})</button>
                                    </td>
                                    <td>{{ $tf->arrival_date }}</td>
                                    <td>{{ $tf->departure_date }}</td>
                                    <td>Rp {{ number_format($tf->total_price) }}</td>
                                    <td>
                                        @if($tf->photo_payment != null)
                                            <img height="70px" width="60px" src="{{ Storage::url($tf->photo_payment) }}" alt="">
                                        @else
                                            <button class="btn btn-warning btn-sm" style="text-align:center">Belum Upload
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tf->payment == 1)
                                            <button class="btn btn-success btn-sm" style="text-align:center">Sudah Bayar</button>
                                        @else
                                            <button class="btn btn-danger btn-sm" style="text-align:center">Belum Bayar
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('user-transaksi-delete',$tf->id) }}" method="POST">
                                            <a title="Upload Bukti" data-toggle="modal" data-target="#uploadBukti" data-placement="top" class="btn btn-success btn-sm edit">
                                                <i class="fas fa-upload" style="color: white;"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Cancel" onClick="deleteConfirm({{ $tf->id }})">
                                                <i class="fas fa-minus" style="color: white;"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="uploadBukti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="img">
            @foreach ($transaction as $tf)
            <form action="{{ route('user-transaksi-upload',$tf->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        @if ($tf->photo_payment != null)
                            <img id="img_payment" src="{{ Storage::url($tf->photo_payment) }}" width="170px" height="170px" alt="foto"
                            style="display: block; margin:auto">
                        @else
                            <img id="img_payment" src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="170px" height="170px" alt="foto"
                            style="display: block; margin:auto">
                        @endif
                        </div>
                    <h5 style="font-weight: 600" for="exampleFormControlFile1">Pilih File</h5>
                        <p>Ukuran File Max 2 MB</p>
                    <input type="file" name="photo_payment" class="form-control-file" id="input_payment">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('addon-script')
<script src="{{ url('/assets/js/page/bootstrap-modal.js') }}"></script>
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            responsive: true,
            "language":{
                "emptyTable": "Tidak ada data yang ditampilkan"
            }
        });
    } );

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    url: "/user/user-transaksi/" + id,
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil di hapus!',
                            icon: 'success',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/user/user-transaksi/"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/user/user-transaksi/"
                    }
                });
            }
        })
    }

    $(function () {
        $("#input_payment").change(function () {
            readURL(this);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_payment').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
