@extends('layouts.user')

@section('title')
    User Transaksi
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
                    {{-- <a href="{{ route('user-transaksi.create') }}" class="btn btn-sm btn-primary mb-3" id="tambah-data"><span i class="fas fa-plus"></span> Tambah Transaksi</a> --}}
                  <div class="table-responsive">
                      <table class="table table-bordered" id="table-1">
                        <p>Pilih tombol <button class="btn btn-success"> <i class="fas fa-upload"></i></button> pada kolom Aksi untuk Upload Bukti Pembayaran </p>
                        <thead>
                            <tr>
                                <th class="text-center">
                                #
                                </th>
                                <th>Nama Pemesan</th>
                                <th>No Kamar</th>
                                <th>Tanggal Pesan</th>
                                <th>Total Harga</th>
                                <th>Foto Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction as $index => $tf)
                            <tr style="text-align: center">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $tf->user->name }}</td>
                                <td>{{ $tf->room->room_number }}</td>
                                <td>{{ $tf->order_date }}</td>
                                <td>{{ $tf->total_price }}</td>
                                {{-- <td>{{ $tf->photo_payment  != null ? $tf->photo_payment : 'Belum Upload ' }}</td> --}}
                                <td>
                                    @if($tf->photo_payment != null)
                                    @else
                                        <button class="btn btn-warning btn-sm" style="text-align:center">Belum Upload
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if($tf->status == 1)
                                        <button class="btn btn-success btn-sm" style="text-align:center">Lunas</button>
                                    @else
                                        <button class="btn btn-danger btn-sm" style="text-align:center">Belum Terbayar
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <form action="#" method="POST">
                                        <a title="Upload Bukti" data-toggle="tooltip" data-placement="top" class="btn btn-success btn-sm edit" href="#"  >
                                            <i class="fas fa-upload"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Cancel" onClick="#">
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
    <!-- Modal -->
    <div class="modal fade" id="uploadBukti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('user-transaksi-upload') }}" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Pilih File</label>
                                <p>Ukuran File Max 2 MB</p>
                            <input type="file" name="photo_payment" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                </div>
            </form>
            </div>
        </div>
    </div>
  </div>
@endsection
@push('addon-script')
<script src="{{ url('/assets/js/page/bootstrap-modal.js') }}"></script>
<script>
    $(document).ready( function () {
        $('#table-1').DataTable({
            responsive: true,
            "language":{
                "emptyTable": "Tidak ada data yang ditampilkan"
            }
        });
    } );
</script>
@endpush
