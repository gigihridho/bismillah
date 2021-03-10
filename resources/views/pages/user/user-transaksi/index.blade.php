@extends('layouts.user')

@section('title')
    User Transaksi
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
                    <a href="{{ route('user-transaksi.create') }}" class="btn btn-sm btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Transaksi</a>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                              <th class="text-center">
                                #
                              </th>
                              <th>Tipe Kamar</th>
                              <th>Kamar</th>
                              <th>Tanggal Pesan</th>
                              <th>Foto Pembayaran</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Kamar Standar</td>
                                  <td>Kamar K1L2</td>
                                  <td>1 Februari 2020</td>
                                  <td><img src="{{ url('/assets/img/bukti.jpg') }}" alt="" width="100px" height="100px"></td>
                                  <td>Belum dikonfirmasi</td>
                              </tr>
                              {{-- <tr>
                                <td>2</td>
                                <td>Kamar Premium</td>
                                <td>Kamar K2L1</td>
                                <td>1 Maret 2021</td>
                                <td><img src="{{ url('/assets/img/bukti.jpg') }}" alt="" width="100px" height="100px"></td>
                                <td>Terkonfirmasi</td>
                            </tr> --}}
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
{{-- <script>
    var datatable = $('#table-1').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url() -> current()!!}',
        },
        columns:[
            {data: 'id', name: 'id'},
            {data: 'room_type.name', name: 'room_type.name'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
            },
        ]
    });
    $(".deleteHarga").click(function(){
        swal({
            title: "Apakah kamu yakin?",
            text: "Jika kamu menghapusnya, maka data akan hilang!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            //proses hapus di sini bisa pakai ajax
            swal("Harga berhasil dihapus", {
            icon: "success",
            });
        } else {
            swal("Data tidak jadi dihapus");
        }
        });
    });
</script> --}}
@endpush
