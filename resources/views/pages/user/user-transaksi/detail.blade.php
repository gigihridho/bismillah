@extends('layouts.user')

@section('title')
    Detail Booking
@endsection

<style type="text/css">
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

/* Modal Content (image) */
.modal-content {
    margin: auto;
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)}
    to {-webkit-transform:scale(1)}
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
    width: 50%;
    }
}

</style>
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('user-transaksi') }}">Booking</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        Detail Booking
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-md-2 mb-4">
                            <ul class="list-group list-group-flush mb-3">
                                @foreach ($transaction as $index => $tf)
                                {{-- <div class="row">
                                    <div class="col-md-6 mb-3"> --}}
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Status</h6>
                                            </div>
                                            @if($tf->transaction_status == "PENDING")
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($tf->transaction_status == "SUCCESS")
                                                <span class="badge badge-success">Selesai</span>
                                            @elseif($tf->transaction_status == "CANCELLED")
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Kode Pemesanan</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->kode }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Nama Lengkap</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->user->name }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">E-mail</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->user->email }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Nomor Telepon</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->user->no_hp }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Total Harga</h6>
                                            </div>
                                            <span class="text-muted">Rp{{ number_format($tf->total_price) }}</span>
                                        </li>
                                    {{-- </div>
                                </div> --}}
                            </ul>
                        </div>
                        <div class="col-md-6 order-md-2 mb-1">
                            <ul class="list-group list-group-flush mb-3">
                                {{-- <div class="row">
                                    <div class="col-md-6 mb-3"> --}}
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Tanggal Pesan</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->tanggal_pesan }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Lama Durasi Sewa</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->durasi }} bulan</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Tanggal Masuk</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->tanggal_masuk }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Tanggal Keluar</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->tanggal_keluar}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0">Nomor Kamar</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->kamar->nomor_kamar }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Tipe Kamar</h6>
                                            </div>
                                            <span class="text-muted">{{ $tf->kamar->tipe_kamar->nama }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                            <h6 class="my-0">Bukti Transaksi</h6>
                                            </div>
                                            @if($tf->bukti_pembayaran != null)
                                            <img id="myImg" height="200px" src="{{ Storage::url($tf->bukti_pembayaran) }}" alt="" onclick="blank">
                                            @else
                                                <button class="btn btn-warning btn-sm" style="text-align:center">Belum Upload
                                                </button>
                                            @endif
                                        </li>
                                    {{-- </div>
                                </div> --}}
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="mx- justify-content-left ml-4">
                            <a href="{{ route('user-transaksi') }}" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </div>
                <!-- The Modal -->
                <div id="myModal" class="modal" style="
                ">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01" style="max-width: 25%; margin:auto;">
                    <div id="caption"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('addon-script')
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
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
