@extends('layouts.user')

@section('title')
    Data Pemesanan
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
    margin-left: 15px;
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

#myImg:hover {opacity: 0.7;}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)}
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
}
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
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
                                    <th scope="col" style="width: 5px">
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
                                    <td>{{ $tf->kode }}</td>
                                    <td><span class="badge badge-info">{{ $tf->kamar->tipe_kamar->nama }} ({{ $tf->kamar->nomor_kamar }})</span>
                                    </td>
                                    <td style="width: 10px">{{ $tf->tanggal_masuk }}</td>
                                    <td style="width: 10px">{{ $tf->tanggal_keluar }}</td>
                                    <td>Rp{{ number_format($tf->total_harga) }}</td>
                                    <td>
                                        @if($tf->bukti_pembayaran == null && $tf->status == "Dibatalkan")
                                            <i class="fas fa-upload" style="color: white;"></i>
                                        @elseif($tf->bukti_pembayaran != null)
                                            <img id="myImg" height="100px" id="myImg" width="100px" src="{{ Storage::url($tf->bukti_pembayaran) }}" alt="image" style="border-radius: 5px;
                                            cursor: pointer;
                                            transition: 0.3s;">
                                        @else
                                        <a title="Upload Bukti" data-toggle="modal" data-target="#uploadBukti" data-placement="top" class="btn btn-success btn-sm edit">
                                            <i class="fas fa-upload" style="color: white;"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tf->status == "Menunggu")
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($tf->status == "Sukses")
                                            <span class="badge badge-success">Sukses</span>
                                        @elseif($tf->status == "Dibatalkan")
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tf->status == "Sukses" || $tf->status == "Dibatalkan")
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
    {{-- Modal --}}
    <div id="myModal" class="modal fade" style="
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.9);" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="img">
            <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <img class="modal-content" id="img01" style="max-width: 25%; margin:auto;">
                <div id="caption"></div>
            </div>
        </div>
    </div>
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
                    <input type="file" name="bukti_pembayaran" id="inpFile">
                    <label for="inpFile" style="color: white;
                        height: 35px;
                        width: 105px;
                        background-color: #03a9f4;
                        position: absolute;
                        margin-left: 6em;
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

    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }
</script>
@endpush
