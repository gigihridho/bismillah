@extends('layouts.admin')

@section('title')
    Kamar
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
                    <a href="{{ route('kamar.create') }}" class="btn btn-sm btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Kamar</a>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                              <th class="text-center">
                                #
                              </th>
                              <th>Nama</th>
                              <th>Tipe Kamar</th>
                              <th>Gambar</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td class="text-center">
                                1
                              </td>
                              <td>Kamar K1L2</td>
                              <td>Tipe Kamar 1</td>
                              <td>
                                <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                              </td>
                              <td>
                                <a href="{{ route('kamar.create') }}" class="btn btn-info"><span i class="fas fa-edit"></span> Edit</a>
                                <a href="{{ route('kamar.index') }}" class="btn btn-danger"><span i class="fas fa-trash-alt"></span> Hapus</a>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-center">
                                2
                              </td>
                              <td>Kamar K1L2</td>
                              <td>Tipe Kamar 2</td>
                              <td>
                                <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                              </td>
                              <td>
                                <a href="{{ route('kamar.create') }}" class="btn btn-info"><span i class="fas fa-edit"></span> Edit</a>
                                <a href="{{ route('kamar.index') }}" class="btn btn-danger"><span i class="fas fa-trash-alt"></span> Hapus</a>
                              </td>
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
