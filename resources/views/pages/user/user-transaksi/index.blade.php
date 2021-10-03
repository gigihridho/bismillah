@extends('layouts.user')

@section('title')
    Booking
@endsection

@section('content')
<style>
        .inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
input[type="file"]{
    display: none;
}
.inputfile + label {
    color: white;
    font: 500 1.5rem/1.5rem Poppins, sans-serif;
    background-color: black;
    display: inline-block;
    margin-left: 3rem;
    margin-top: 2rem;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: red;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
.inputfile:focus + label,
.inputfile.has-focus + label {
    outline: 1px dotted #000;
    outline: -webkit-focus-ring-color auto 5px;
}
.image-preview {
    width: 250px;
    min-height: 170px;
    border: 2px dashed #afeeee;
    margin-top: 15px;
    margin-left: 3em;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #cccccc;
}
.image-preview__image{
    display: none;
    width: 100%;
}
.image-preview__default-text {
    color:#87ceeb;

}
.inpFile {
    margin-left: 3rem;
    margin-top: 2rem;
    color: #000;
}
input[type="file"]{
    display: none;
}
/* label {
    color: white;
    height: 35px;
    width: 105px;
    background-color: #03a9f4;
    position: absolute;
    margin-left: 8.5em;
    padding: 10px;
    border-radius: 10px;
    padding-top: 8px;
    padding-left: 20px;
    font-weight: lighter;
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1em;
} */
label:hover {
    opacity: 80%;
}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data @yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            <h6>{{$errors->first()}}</h6>
        </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-1">
                            <p>Klik tombol <button class="btn btn-success"> <i class="fas fa-upload"></i></button> untuk Upload Bukti Pembayaran </p>
                            @if ($transaction->count() > 0)
                            <a href="{{ route('lanjut-sewa') }}" class="btn btn-primary mb-3"><span i class="fas fa-plus"></span> Perpanjang Sewa</a>
                            @endif
                            <thead>
                                <tr style="text-align: center">
                                    <th scope="col">
                                    No
                                    </th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Kamar</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Tanggal Keluar</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Bukti Transaksi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transaction as $tf)
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $tf->code }}</td>
                                    <td><span class="badge badge-info">{{ $tf->room->room_type->name }} ({{ $tf->room->room_number }})</span>
                                    </td>
                                    <td>{{ $tf->arrival_date }}</td>
                                    <td>{{ $tf->departure_date }}</td>
                                    <td>Rp{{ number_format($tf->total_price,2,',','.') }}</td>
                                    <td>
                                        @if ($tf->status == "Dibatalkan")
                                            <i class="fas fa-upload" style="color: white;"></i>
                                        @elseif($tf->photo_payment != null)
                                            <img height="100px" id="myImg" width="100px" src="{{ Storage::url($tf->photo_payment) }}" alt="image">
                                        @else
                                        <a title="Upload Bukti" data-toggle="modal" data-target="#uploadBukti" data-placement="top" class="btn btn-success btn-sm edit">
                                            <i class="fas fa-upload" style="color: white;"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tf->status == "Menunggu")
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($tf->status == "Selesai")
                                            <span class="badge badge-success">Selesai</span>
                                        @elseif($tf->status == "Dibatalkan")
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tf->status == "Selesai")
                                            <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" href="{{ route('user-transaksi-detail',$tf->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        @else
                                        <a title="Invoice" data-toggle="tooltip" data-placement="top" class="btn btn-warning btn-sm" href="{{ route('user-invoice',$tf->id) }}">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a>
                                        <a title="Detail" data-toggle="tooltip" data-placement="top" class="btn btn-info btn-sm" href="{{ route('user-transaksi-detail',$tf->id) }}">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        @endif
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
    @foreach ($transaction as $tf)
    <div class="modal fade" id="uploadBukti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="img">
            <form action="{{ route('user-transaksi-upload',$tf->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="image-preview" id="imagePreview">
                        <img src="" alt="Image Preview" class="image-preview__image">
                            <span class="image-preview__default-text">
                            +</span>
                    </div>
                    <input type="file" name="photo_payment" id="inpFile">
                    <label for="inpFile" style="color: white;
                        height: 35px;
                        width: 105px;
                        background-color: #03a9f4;
                        position: absolute;
                        margin-left: 8.5em;
                        padding: 10px;
                        border-radius: 10px;
                        padding-top: 8px;
                        padding-left: 20px;
                        font-weight: lighter;
                        font-size: 12px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        margin-top: 1em;">
                    <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                        Pilih foto
                    </label>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
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

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda ingin membatalkan transaksi ini?",
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
                    url: "/user/user-transaksi/" + id,
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "POST",
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pemesanan berhasil dibatalkan',
                            icon: 'success',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/user/user-transaksi/"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Pemesanan tidak dapat dibatalkan!',
                            icon: 'warning',
                        });
                        window.location.href = "/user/user-transaksi/"
                    }
                });
            }
        })
    }

    const inpFile = document.getElementById("inpFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

    inpFile.addEventListener("change", function(){

        const file = this.files[0];

        if (file){
            const reader = new FileReader();

            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";

            reader.addEventListener("load", function(){

                previewImage.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);
        }else {
            previewDefaultText.style.display = null;
            previewImage.style.display = null;
            previewImage.setAttribute("src", "");
        }
    });


</script>
@endpush
