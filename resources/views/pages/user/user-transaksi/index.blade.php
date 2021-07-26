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
                                    <th>
                                    No
                                    </th>
                                    <th>Kode</th>
                                    <th>Kamar</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Total Harga</th>
                                    <th>Foto Pembayaran</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transaction as $tf)
                                <tr style="text-align: center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $tf->kode }}</td>
                                    <td><span class="badge badge-info">{{ $tf->room->room_type->name }} ({{ $tf->room->room_number }})</span>
                                    </td>
                                    <td>{{ $tf->arrival_date }}</td>
                                    <td>{{ $tf->departure_date }}</td>
                                    <td>Rp{{ number_format($tf->total_price,2,',','.') }}</td>
                                    <td>
                                        @if($tf->photo_payment != null)
                                            <img height="70px" width="60px" src="{{ Storage::url($tf->photo_payment) }}" alt="">
                                        @else
                                        <a title="Upload Bukti" data-toggle="modal" data-target="#uploadBukti" data-placement="top" class="btn btn-success btn-sm edit">
                                            <i class="fas fa-upload" style="color: white;"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tf->status == "Menunggu")
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($tf->status == "Terisi")
                                            <span class="badge badge-success">Terisi</span>
                                        @elseif($tf->status == "Keluar")
                                            <span class="badge badge-danger">Keluar</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <form action="{{ route('user-transaksi-delete',$tf->id) }}" method="POST">
                                            <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="Cancel" onClick="deleteConfirm({{ $tf->id }})">
                                                <i class="fas fa-minus" style="color: white;"></i>
                                            </a>
                                        </form>
                                    </td> --}}
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
                    url: "/user/user-transaksi/" + id,
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Pemesanan berhasil dicancel',
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
                            text: 'Pemesanan tidak dapat di hapus!',
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
