@extends('layouts.fe')

@section('title')
    Unggah Bukti Pembayaran
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
.inputfile + label {
    font-size: 1.25em;
    font-weight: 700;
    color: white;
    background-color: black;
    display: inline-block;
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
</style>
<section class="h-100 w-100 bg-white" style="box-sizing: border-box" id="benefit" data-aos="fade-up">
    <div class="content-3-2 container-xxl mx-auto position-relative" style="font-family: 'Poppins', sans-serif">
        <h4 class="d-flex justify-content-center mb-3">Silakan unggah bukti pembayaran ya</h4>
        <div class="d-flex flex-lg-row flex-column align-items-center">
        <!-- Left Column -->
        <div class="col-lg-6 left-column d-flex flex-column align-items-lg-start text-lg-start text-center">
            <h6>Hai</h6>
            @foreach ($transaction as $tf)
            <form action="{{ route('upload-pembayaran',$tf->id) }}" method="POST" enctype="multipart/form-data">
                <input type="file" name="photo_payment">
                <button type="submit">Kirim</button>
            </form>
            @endforeach
        </div>
        <!-- Right Column -->
        <div class="col-lg-6 right-column d-flex flex-column align-items-lg-start align-items-center text-lg-start text-center">
            <h4 class="title-text">Cara Pembayaran</h4>
            <ul style="padding: 0; margin: 0 30px">
            <li class="list-unstyled">
                <h6
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    1
                </span>
                Transfer Bank
                </h6>
                <p class="text-caption">
                    <a class="nav-link button4" data-toggle="collapse" data-target="#bni"
                    style="margin-buttom:10px; text-align:left">
                    <img src="https://bimbel.ruangguru.com/hubfs/BNI.png"
                        style="width:55px; margin-bottom: 10px;margin-top: 10px;">
                    <br>Bank Transfer BNI
                </a>
                <div id="bni">
                    <ol style="text-align:left; color: #4a4a4a">
                        <li>Masukkan kartu pilih <b>bahasa</b>, dan masukkan PIN
                            Anda.</li>
                        <li>Pada menu utama, pilih <b>Transaksi Lainnya.</b></li>
                        <li>Pilih <b>Transfer</b> dan pilih <b>ke rekening BNI.</b>
                        </li>
                        <li>Masukkan nominal transfer sesuai dengan total tagihan
                            transaksi <b>ke no rek 5829019311
                                a.n Agam.</b></li>
                        <li><b>Simpan bukti pembayaran dan unggah bukti </b>pada
                            halaman yang tersedia.</li>
                    </ol>
                </div>
                </p>
            </li>
            <li class="list-unstyled" style="margin-bottom: 2rem">
                <h6
                class="title-caption d-flex flex-lg-row flex-column align-items-center justify-content-lg-start justify-content-center">
                <span class="circle text-white d-flex align-items-center justify-content-center">
                    2
                </span>
                Dompet Digital
                </h6>
                <p class="text-caption">
                    <a class="nav-link button4" data-toggle="collapse" data-target="#indo"
                        style="text-align:left">
                        <img src="https://bimbel.ruangguru.com/hubfs/Logo%20OVO.png"
                            style="width:43px; margin-bottom: 10px;margin-top: 10px; font-size: 19px;">
                        <br>Pembayaran Via OVO
                    </a>
                    <div class="collapse" id="indo">
                        <ol style="text-align:left; color: #4a4a4a">
                            <li>Buka aplikasi pembayaran OVO Anda.</b></li>
                            <li>Pilih menu <b>transfer.</b></li>
                            <li>Masukan nominal sesuai tagihan pada Inofa Bimbel.</li>
                            <li>Pilih menu <b>transfer antar OVO.</b></li>
                            <li>Masukan <b>nomor tujuan 08572839211 a.n Agam
                            </li>
                            <li>Periksa detail transaksi Anda pada aplikasi, lalu tap
                                tombol <b>transfer.</b></li>
                            <li>Transaksi Anda sudah selesai.</li>
                        </ol>
                    </div>
                </p>
            </li>
            </ul>
        </div>
        </div>
    </div>
</section>
@endsection
@push('after-script')
    <script src="{{ asset('dropzone/dist/dropzone.js') }}"></script>
    <script type="text/javascript">
    $(function () {
        $("#photo_payment").change(function () {
            readURL(this);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_payment').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
@endpush
