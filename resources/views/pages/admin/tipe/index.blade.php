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
                          #
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
                            @php $no = 1; @endphp
                            @foreach ($data as $d)
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
                                        <button class="btn btn-success btn-sm" style="text-align:center">Aktif</button>
                                    @else
                                        <button class="btn btn-danger btn-sm" style="text-align:center">Tidak Aktif
                                        </button>
                                    @endif
                                </td>
                                <td class="flex">
                                    <a title="edit" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm edit" href="{{ route('tipe.edit', $d->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a title="manage kamar" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm edit" href="{{ route('tipe.index',$d->id,'kamar') }}"  >
                                        <i class="far fa-bed"></i>
                                    </a>
                                    <form action="{{ route('tipe.destroy',$d->id) }}" method="POST"
                                        data-toggle="tooltip" data-placement="top" title="Hapus" class="destroy">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            style="color:white"><i class="far fa-trash-alt"></i>
                                        </button>
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
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#table-1').DataTable({
        });
    } );
    </script>
@endpush
