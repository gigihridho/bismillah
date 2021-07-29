@extends('layouts.admin')

@section('title')
    Pemasukan
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data @yield('title')</h1>
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
                    {{-- <form action="{{ route('search') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="order_date">Tanggal Awal</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control sm" id="from" name="fromDate" required/>
                                    </div>
                                    <label for="order_date">Tanggal Akhir</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control sm" id="to" name="toDate" required/>
                                    </div>
                                    <div class="col-sm-2 mt-2 form-group">
                                        <button type="submit" class="btn btn-primary" name="search" title="Search">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form> --}}
                    <a href="{{ route('pemasukan-pdf') }}" class="btn btn-success mb-3" id="cetakPDF"><span i class="fas fa-print"></span> Print PDF</a>
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr style="text-align:center">
                            <th style="width: 10px" class="text-center">
                            No
                            </th>
                            <th>Kode Pemesanan</th>
                            <th>Nama Pemesan</th>
                            <th>Tanggal Transaksi</th>
                            <th>Pemasukan</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction)
                                <tr style="text-align:center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $transaction->kode }}</td>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->order_date }}</td>
                                    <td>Rp {{ number_format($transaction->room->room_type->price,2,',','.') }}</td>
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
