@extends('layouts.admin')

@section('title')
    Transaksi Sudah Bayar
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
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align: center">
                            <th>
                            No
                            </th>
                            <th>Nama</th>
                            <th>Kode Pemesanan</th>
                            <th>Bukti Transaksi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction)
                            <tr style="text-align: center">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->kode }}</td>
                                <td>
                                    @if($transaction->photo_payment != null)
                                        <img height="100px" src="{{ Storage::url($transaction->photo_payment) }}" alt="" onclick="blank">
                                    @else
                                        <span class="badge badge-warning">Belum Upload</span>
                                    @endif
                                </td>
                                <td>
                                    @if($transaction->payment == 1)
                                        <span class="badge badge-success">Sudah Bayar</span>
                                    @else
                                        <span class="badge badge-warning">Belum Bayar</span>
                                    @endif
                                </td>
                                <td>
                                    @if($transaction->status == "Menunggu")
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($transaction->status == "Terisi")
                                        <span class="badge badge-success">Terisi</span>
                                    @elseif($transaction->status == "Keluar")
                                        <span class="badge badge-danger">Keluar</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- <form action="{{ route('booking.destroy',$room_booking->id) }}" method="POST"> --}}
                                        <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="/admin/booking/{{ $transaction->id }}/edit">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-sm" href="{{ route('detail-booking',$transaction->id) }}">
                                            <i class="far fa-eye"></i>
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
