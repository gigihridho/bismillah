@extends('layouts.admin')

@section('title')
    Laporan Transaksi
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
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
                    <a href="{{ route('transaski-pdf') }}" class="btn btn-primary mb-3" id="cetakPDF"><span i class="fas fa-print"></span> Print PDF</a>
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align:center; text-transform: uppercase">
                            <th style="width: 10px" class="text-center">
                            No
                            </th>
                            <th>Nama Pemesan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Pemasukan</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction)
                                <tr style="text-align:center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->order_date }}</td>
                                    <td>Rp {{ number_format($transaction->room->room_type->price) }}</td>
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
