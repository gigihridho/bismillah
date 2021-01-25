@extends('layouts.admin')

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
          <div class="breadcrumb-item">Table @yield('title')</div>
        </div>
      </div>

      <div class="section-body" id="facilities_create">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tambah Fasilitas</h4>
                  </div>
                  <div class="card-body">
                      <form id="facilities_store" action="{{ route('fasilitas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Fasilitas</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Icon</label>
                                    <input type="file" name="icon" class="form-control"required>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" id="submit" class="btn btn-success px-5" onclick="simpanData()">
                                        Simpan Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
              </div>
          </div>
      </div>
    </section>
  </div>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
    function simpanData(id) {
        swal({
            'Good job!',
            'You clicked the button!',
            'success'
            showCancelButton: !0,
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: '{!! url()->current() !!}',
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {

                        if (results.success === true) {
                            swal("Done!", results.message, "success");
                        } else {
                            swal("Error!", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }

    Swal.fire(

)
  </script>

@endpush
