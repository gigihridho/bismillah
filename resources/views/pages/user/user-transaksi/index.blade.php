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
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user-transaksi-upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Pilih File</label>
                            <p>Ukuran File Max 2 MB</p>
                        <input type="file" name="photo_payment" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
        </div>
    </div>
  </div>
@endsection
@push('addon-script')
<script src="{{ url('/assets/js/page/bootstrap-modal.js') }}"></script>
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>
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
            {data: 'user.name', name: 'user.name'},
            {data: 'room.room_number', name: 'room.room_number'},
            {data: 'order_date', name: 'order_date'},
            {data: 'total_price', name: 'total_price'},
            {data: 'photo_payment', name: 'photo_payment'},
            {data: 'status',name: 'status'},
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
    });
</script>
@endpush
