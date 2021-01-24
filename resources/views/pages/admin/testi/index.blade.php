@extends('layouts.admin')

@section('title')
    Testimoni
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
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>Nama</th>
                        <th>Testimoni</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">
                          1
                        </td>
                        <td>Agung</td>
                        <td>Kamarnya bagus</td>
                        <td>
                            <a href="{{ route('testimoni.index') }}" class="btn btn-danger"><span i class="fas fa-trash-alt"></span> Hapus</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center">
                          2
                        </td>
                        <td>Budi</td>
                        <td>Kamarnya bagus</td>
                        <td>
                            <a href="{{ route('testimoni.index') }}" class="btn btn-danger"><span i class="fas fa-trash-alt"></span> Hapus</a>
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
