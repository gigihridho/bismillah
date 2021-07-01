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
                              <th>Availability</th>
                              <th>Status</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($room_type->rooms as $index => $room)
                              <tr style="text-align:center">
                                  <td>{{ $index+1 }}</td>
                                  <td>{{ $room_type->name}}</td>
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
                                    <form action="/admin/tipe/{{ $room_type->id }}/kamar/{{ $room->id }}" method="POST">
                                        <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="/admin/tipe/{{ $room_type->id }}/kamar/{{ $room->id }}/edit">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $room->id }})">
                                        <i class="far fa-trash-alt" style="color: white;"></i>
                                        </a>
                                    </form>
                                  </td>
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
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            responsive: true,
            "language":{
                "emptyTable": "Tidak ada data yang ditampilkan"
            }
        });
    } );

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    url: "admin/tipe/{{ $room_type->id }}/kamar/" + id,
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil di hapus!',
                            icon: 'success',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/admin/tipe/{{ $room_type->id }}/kamar"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/tipe/{{ $room_type->id }}/kamar"
                    }
                });
            }
        })
    }
</script>
@endpush
