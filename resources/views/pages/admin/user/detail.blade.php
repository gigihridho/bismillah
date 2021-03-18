@extends('layouts.admin')

@section('title')
    Data Penghuni
@endsection

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Table @yield('title')</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item">Detail @yield('title')</div>
        </div>
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" table-bordered" id="table-1" cellspacing="0" style="width: 100%">
                    <thead>
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Foto Ktp</th>
                        <th>Profesi</th>
                        <th>Alamat</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $it)
                            <tr>
                                <td>{{ $it->id }}</td>
                                <td>{{ $it->name }}</td>
                                <td>{{ $it->email }}</td>
                                <td>{{ $it->no_hp }}</td>
                                <td><img src="{{ Storage::url($it->photo_ktp) }}" alt="Responsive image" width="80px" height="auto"></td>
                                <td>{{ $it->profession }}</td>
                                <td>{{ $it->address }}</td>
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
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>
<script>
$(document).ready( function () {
    $('#table-1').DataTable();
} );
</script>
@endpush
