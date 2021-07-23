@extends('layouts.admin')

@section('title')
    Fasilitas
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data @yield('title')</h1>
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
                    <a href="{{ route('fasilitas.create') }}" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Fasilitas</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-1" cellspacing="0" style="width: 100%">
                            <thead>
                            <tr style="text-align:center">
                                <th class="text-center" style="width: 5%">
                                No
                                </th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($facilites as $index => $facility)
                                <tr style="text-align: center">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $facility->name }}</td>
                                    <td>
                                        @if($facility->status == 1)
                                            <button class="btn btn-success btn-sm btn-fill">Aktif</button>
                                        @else
                                            <button class="btn btn-warning btn-sm btn-fill">Tidak Aktif
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('fasilitas.destroy',$facility->id) }}" method="POST">
                                            <a title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('fasilitas.edit',$facility->id) }}">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Hapus" onClick="deleteConfirm({{ $facility->id }})">
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
                    url: "fasilitas/" + id,
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
                                window.location.href = "fasilitas/"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "fasilitas/"
                    }
                });
            }
        })
    }
</script>
@endpush
