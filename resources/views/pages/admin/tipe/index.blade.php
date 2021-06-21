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
                <a href="{{ route('tipe.create') }}" class="btn btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Tipe Kamar</a>
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          #
                        </th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Lantai</th>
                        <th>Harga</th>
                        <th>Ukuran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @php $no = 1; @endphp
                            @foreach($data as $d)
                            <td>{{ $no++ }}</td>
                            <td>{{ $d->name }}</td>
                            <td>
                                <img height="70px" src="{{ Storage::url($d->photo) }}" alt="">
                            </td>
                            <td>{{ $d->floor }}</td>
                            <td>{{ $d->price }}</td>
                            <td>{{ $d->size }}</td>
                            <td>
                                @if($d->status == 1)
                                    <button class="btn btn-success btn-sm btn-fill">Aktif</button>
                                @else
                                    <button class="btn btn-danger btn-sm btn-fill">Tidak Aktif
                                    </button>
                                @endif
                            </td>
                            <td>
                                <a title="edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('tipe.edit', $d->id) }}">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a title="manage kamar" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm edit" href="{{ route('kamar.index', $d->id) }}"  >
                                    <i class="far fa-bed"></i>
                                </a>
                                <a title="hapus" data-toggle="tooltip" data-placement="top" class="btn btn-danger btn-sm edit" href="route('tipe.edit', $d->id)">
                                    <i class="far fa-trash-alt"></i>
                                </a>
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
    $(document).ready( function () {
        $('#table-1').DataTable();
    } );
    </script>
    @endpush
