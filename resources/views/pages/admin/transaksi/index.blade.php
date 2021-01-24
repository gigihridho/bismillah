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
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          1
                        </td>
                        <td>Agung</td>
                        <td class="align-middle">
                          Kamar L1K2
                        </td>
                        <td>20-12-2019</td>
                        <td>
                            <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                        </td>
                        <td>20-12-2019</td>
                        <td>20-01-2020</td>
                        <td>Rp 600.000</td>
                        <td><div class="badge badge-success">Konfirmasi</div></td>
                        <td><a href="#" class="btn btn-danger">Hapus</a></td>
                      </tr>
                      <tr>
                        <td>
                          2
                        </td>
                        <td>Budi</td>
                        <td class="align-middle">
                          Kamar L2K2
                        </td>
                        <td>20-2-2020</td>
                        <td>
                            <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                        </td>
                        <td>21-02-2020</td>
                        <td>20-08-2020</td>
                        <td>Rp 4.800.000</td>
                        <td><div class="badge badge-success">Konfirmasi</div></td>
                        <td><a href="#" class="btn btn-danger">Hapus</a></td>
                      </tr>

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
    $(document).ready(function(){
        $('#table-1').DataTable({
            "autoWidth": false
        });
    });
</script>
@endpush
