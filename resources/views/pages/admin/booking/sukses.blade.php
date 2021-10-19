@extends('layouts.admin')

@section('title')
    Data Pemesanan Sukses
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
                    <p>Buat tagihan untuk bulan selanjutnya dengan menekan tombol (+)</p>
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
                            @foreach ($pemesanans as $index => $tf)
                            <tr style="text-align: center">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $tf->user->name }}</td>
                                <td>{{ $tf->kode }}</td>
                                <td>
                                    @if($tf->bukti_pembayaran != null)
                                        <img height="100px" src="{{ Storage::url($tf->bukti_pembayaran) }}" alt="" onclick="blank">
                                    @else
                                        <span class="badge badge-warning">Belum Upload</span>
                                    @endif
                                </td>
                                <td>
                                    @if($tf->status == "Menunggu")
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($tf->status == "Sukses")
                                        <span class="badge badge-success">Sukses</span>
                                    @elseif($tf->status == "Dibatalkan")
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- <form action="{{ route('booking.destroy',$room_booking->id) }}" method="POST"> --}}
                                        {{-- <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="/admin/booking/{{ $tf->id }}/edit">
                                            <i class="far fa-edit"></i>
                                        </a> --}}
                                        <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" href="{{ route('detail-booking',$tf->id) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <a title="Detail" data-toggle="tooltip" data-placement="top" href="{{ route('buat-tagihan',$tf->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i>
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
</script>
@endpush
