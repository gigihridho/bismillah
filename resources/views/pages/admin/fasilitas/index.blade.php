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
                <a href="{{ route('fasilitas.create') }}" class="btn btn-sm btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Fasilitas</a>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table-1" cellspacing="0" style="width: 100%">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5%">
                          ID
                        </th>
                        <th>Nama</th>
                        <th>Icon</th>
                        <th>Slug</th>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            {data: 'icon', name: 'icon'},
            {data: 'slug', name: 'slug'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
            },
        ]
    })
</script>
<script>
    window.deleteconfirmation = function(formId)
    {
    Swal.fire({
        icon: 'warning',
        text: 'Do you want to delete this?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
        // $(".delete").click(function(e) {
        //     id = e.target.daataset.id
        //     swal({
        //         title: 'Are you sure?',
        //         text: 'Once deleted, you will not be able to recover this imaginary file!',
        //         icon: 'warning',
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //         swal('Poof! Your imaginary file has been deleted!', {
        //             icon: 'success',
        //         });
        //         } else {
        //         swal('Your imaginary file is safe!');
        //         }
        //     });
        // });

</script>
@endpush
