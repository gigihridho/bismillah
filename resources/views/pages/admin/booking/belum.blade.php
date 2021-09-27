@extends('layouts.admin')

@section('title')
    Transaksi Menunggu
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
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
                    @include('includes.tabs')
                    <div class="table-responsive mt-2">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align: center">
                            <th scope="col">
                            No
                            </th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kode Pemesanan</th>
                            <th scope="col">Bukti Transaksi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction)
                            <tr style="text-align: center">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->code }}</td>
                                <td>
                                    @if($transaction->photo_payment != null)
                                        <img height="100px" src="{{ Storage::url($transaction->photo_payment) }}" alt="" onclick="blank">
                                    @else
                                        <span class="badge badge-danger">Belum Upload</span>
                                    @endif
                                </td>
                                <td>
                                    @if($transaction->status == "Menunggu")
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($transaction->status == "Selesai")
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($transaction->status == "Dibatalkan")
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- <form action="{{ route('booking.destroy',$room_booking->id) }}" method="POST"> --}}
                                        <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="/admin/booking/{{ $transaction->id }}/edit">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Detail" href="{{ route('detail-booking',$transaction->id) }}">
                                            <i class="far fa-eye" style="color: white;"></i>
                                        </a>
                                    {{-- </form> --}}
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
    // function deleteConfirm(id) {
    //     Swal.fire({
    //         title: 'Harap Konfirmasi',
    //         text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Lanjutkan'
    //     }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
    //                 },
    //                 url: "booking/" + id,
    //                 method: "post",
    //                 data: {
    //                     "_token": "{{ csrf_token() }}",
    //                     "_method": "DELETE",
    //                     id: id
    //                 },
    //                 success: function (data) {
    //                     Swal.fire({
    //                         title: 'Berhasil!',
    //                         text: 'Data berhasil di hapus!',
    //                         icon: 'success',
    //                     }).then((result) => {
    //                         if (result.value) {
    //                             window.location.href = "booking/"
    //                         }
    //                     });
    //                 },
    //                 error: function () {
    //                     Swal.fire({
    //                         title: 'Gagal!',
    //                         text: 'Data tidak dapat di hapus!',
    //                         icon: 'warning',
    //                     });
    //                     window.location.href = "booking/"
    //                 }
    //             });
    //         }
    //     })
    // }
</script>
@endpush
