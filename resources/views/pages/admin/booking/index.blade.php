@extends('layouts.admin')

@section('title')
    Booking
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Table @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin-dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align: center; text-transform: uppercase">
                            <th>
                            No
                            </th>
                            <th>Nama</th>
                            <th>No Kamar</th>
                            <th>Tipe</th>
                            <th>Bukti Transaksi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($room_bookings as $index => $room_booking)
                            <tr style="text-align: center">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $room_booking->user->name }}</td>
                                <td>{{ $room_booking->room->room_number }}</td>
                                <td>{{ $room_booking->room->room_type->name }}</td>
                                <td>
                                    @if($room_booking->photo_payment != null)
                                        <img height="60px" src="{{ Storage::url($room_booking->photo_payment) }}" alt="">
                                    @else
                                        <button class="btn btn-warning btn-sm" style="text-align:center">Belum Upload
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($room_booking->payment == 1)
                                        <button class="btn btn-success btn-sm btn-fill">Sudah Bayar</button>
                                    @else
                                        <button class="btn btn-danger btn-sm btn-fill">Belum Bayar</button>
                                    @endif
                                </td>
                                <td>
                                    @if($room_booking->status == "Menunggu")
                                        <button class="btn btn-warning btn-sm" style="text-align:center">Menunggu</button>
                                    @elseif($room_booking->status == "Terisi")
                                        <button class="btn btn-success btn-sm" style="text-align:center">Terisi</button>
                                    @elseif($room_booking->status == "Keluar")
                                        <button class="btn btn-danger btn-sm" style="text-align:center">Keluar</button>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('booking.destroy',$room_booking->id) }}" method="POST">
                                        <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="/admin/booking/{{ $room_booking->id }}/edit">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{$room_booking->id}})">
                                            <i class="far fa-trash-alt" style="color: white;"></i>
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
</div>
@endsection
@push('addon-script')
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
                    url: "booking/" + id,
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
                                window.location.href = "booking/"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "booking/"
                    }
                });
            }
        })
    }
</script>
@endpush
