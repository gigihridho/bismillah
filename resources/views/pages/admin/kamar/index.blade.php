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
                    <a href="/admin/tipe/{{ $room_type->id }}/kamar/create" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Kamar</a>
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table-1">
                        <thead>
                            <tr>
                              <th class="text-center">
                                #
                              </th>
                              <th>Tipe Kamar</th>
                              <th>Nomor Kamar</th>
                              <th>Status</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  @foreach ($room_type->rooms as $index => $room)
                                  <td>{{ $index+1 }}</td>
                                  <td>{{ $room->room_type_id }}</td>
                                  <td>{{ $room->room_number }}</td>
                                  <td>
                                    @if($room->available == 1)
                                    <button class="btn btn-danger btn-xs btn-fill">Available</button>
                                    @else
                                    <button class="btn btn-default btn-xs btn-fill">Booked</button>
                                    @endif
                                  </td>
                                  <td>
                                    @if($room->status == 1)
                                    <button class="btn btn-success btn-xs btn-fill">Aktif</button>
                                    @else
                                    <button class="btn btn-default btn-xs btn-fill">Tidak Aktif</button>
                                    @endif
                                  </td>
                                  <td>
                                    <form action="{{ route('tipe.destroy',$room->id) }}" method="POST">
                                        <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('tipe.edit', $room->id) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a title="manage kamar" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm edit" href="{{ route('tipe.index',$room->id,'kamar') }}"  >
                                            <i class="far fa-bed"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $room->id }})">
                                        <i class="far fa-trash-alt" style="color: white;"></i>
                                        </a>
                                    </form>
                                  </td>
                                  @endforeach
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
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            responsive: true
        });
    } );
    // var datatable = $('#table-1').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ordering: true,
    //     ajax: {
    //         url: '{!! url() -> current()!!}',
    //     },
    //     columns:[
    //         {data: 'DT_RowIndex', name: 'id'},
    //         {data: 'room.name', name: 'room.name'},
    //         {data: 'room.status', name: 'room.status'},
    //         {
    //             data: 'action',
    //             name: 'action',
    //             orderable: false,
    //             searchable: false,
    //         },
    //     ],
    //     "language":{
    //         "emptyTable": "Tidak ada data yang ditampilkan"
    //     }
    // });

    // $(document).on('click', '.delete', function () {
    //         dataId = $(this).attr('id');
    //         $('#konfirmasi-modal').modal('show');
    // });
</script>
@endpush
