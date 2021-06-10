@extends('layouts.admin')

@section('title')
    Transaksi
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
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>Nama</th>
                        <th>Kamar</th>
                        <th>Tanggal Transaksi</th>
                        <th>Bukti Transaksi</th>
                        <th>Durasi</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
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
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>
<script>
    var datatable = $('#table-1').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url() -> current()!!}',
        },
        columns:[
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'user.name', name: 'user.name'},
            {data: 'room.name', name: 'room.name'},
            {data: 'order_date', name: 'order_date'},
            {data: 'photo_payment', name: 'photo_payment'},
            {data: 'duration', name: 'duration'},
            {data: 'arrival_date', name: 'arrival_date'},
            {data: 'departure_date', name: 'departure_date'},
            {data: 'total_price', name: 'total_price'},
            {data: 'status',name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
            },
        ],
        "language":{
            "emptyTable": "Tidak ada data yang ditampilkan"
        }
    });
</script>
@endpush
