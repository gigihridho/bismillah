@extends('layouts.admin')

@section('title')
    Tipe Kamar
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
                <a href="{{ route('tipe.create') }}" class="btn btn-sm btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Tipe Kamar</a>
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th style="width: 30%">Deskripsi</th>
                        <th>Harga</th>
                        <th>Luas</th>
                        <th>Slug</th>
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
  <div class="modal" id="delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            {data: 'name', name: 'name'},
            {data: 'photo', name: 'photo'},
            {data: 'description', name: 'description'},
            {data: 'price', name: 'price'},
            {data: 'size', name: 'size'},
            {data: 'slug', name: 'slug'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
            },
        ]
    });
</script>
@endpush
