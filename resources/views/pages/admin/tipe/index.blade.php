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
              <div class="card-body" style="overflow-x:auto;">
                <a href="{{ route('tipe.create') }}" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Tipe Kamar</a>
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr style="text-align:center; text-transform: uppercase">
                        <th style="width: 10px" class="text-center">
                          No
                        </th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th style="width: 20px">Lantai</th>
                        <th style="width: 20px">Harga</th>
                        <th style="width: 20px">Ukuran</th>
                        <th>Status</th>
                        <th style="width: 100px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($data as $index => $d)
                                <td>{{ $index+1 }}</td>
                                <td>{{ $d->name }}</td>
                                <td>
                                    <img height="70px" src="{{ Storage::url($d->photo) }}" alt="">
                                </td>
                                <td>{{ $d->floor }}</td>
                                <td>{{ $d->price }}</td>
                                <td>{{ $d->size }}</td>
                                <td>
                                    @if($d->status == 1)
                                        <button class="btn btn-success btn-sm" style="text-align:center">Aktif</button>
                                    @else
                                        <button class="btn btn-danger btn-sm" style="text-align:center">Tidak Aktif
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('tipe.destroy',$d->id) }}" method="POST">
                                        <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('tipe.edit', $d->id) }}">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a title="manage kamar" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm edit" href="/admin/tipe/{{ $d->id }}/kamar"  >
                                            <i class="far fa-bed"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $d->id }})">
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
                    url: "tipe/" + id,
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
                                window.location.href = "/admin/tipe"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/tipe"
                    }
                });
            }
        })
    }
</script>
@endpush
