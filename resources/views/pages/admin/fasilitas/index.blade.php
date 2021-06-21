@extends('layouts.dashboard')

@section('title')
    Fasilitas
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
                <a href="{{ route('fasilitas.create') }}" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Fasilitas</a>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table-1" cellspacing="0" style="width: 100%">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5%">
                          ID
                        </th>
                        <th>Nama</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
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
<script src="sweetalert2.all.min.js"></script>
<script>
    var datatable = $('#table-1').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns:[
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'name', name: 'name'},
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
    })
</script>
<script>
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
        }
    })
@endpush
