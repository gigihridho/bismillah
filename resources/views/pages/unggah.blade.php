@extends('layouts.fe')

@section('title')
    Unggah Bukti Pembayaran
@endsection

@section('content')
<style>
    .invoice h6{
        margin-left: 3rem;
        line-height: 3em;
        font: 500 1.5rem/1.5rem Poppins, sans-serif;
        margin-bottom: 1.25rem;
        color: #121212;
    }
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
/* .image-preview {
    width: 200px;
    min-height: 180px;
    border: 2px dashed #afeeee;
    margin-top: 15px;
    margin-left: 9em;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #cccccc;
} */
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
.btn-primary{
    margin-top:5rem;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
    color: white;
    margin-left: 11em;
    display: table;
    font-size: 18px;
    margin-bottom: 10px;
    border-color: #fff;
}
label {
    margin-top: 1em;
    color: white;
    height: 40px;
    width: 120px;
    background-color: #03a9f4;
    position: absolute;
    font-size: 12px Poppins, sans-serif;
    margin-left: 11.5em;
    margin-bottom: 5rem;
    padding: 10px;
    border-radius: 10px;
    padding-top: 8px;
    padding-left: 20px;
    justify-content: center;
    align-items: center;
}
label:hover {
    opacity: 80%;
}
@media screen and (min-width: 0px) and  (max-width: 360px) {
    label {
        margin-top: 1em;
        color: white;
        height: 40px;
        width: 120px;
        background-color: #03a9f4;
        position: absolute;
        font-size: 12px Poppins, sans-serif;
        margin-left: -3.5em;
        margin-bottom: 5rem;
        padding: 10px;
        border-radius: 10px;
        padding-top: 8px;
        padding-left: 20px;
        justify-content: center;
        align-items: center;
    }
    .btn-primary{
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        margin: 5rem auto;
        display: table;
        font-size: 18px;
        margin-bottom: 10px;
        border-color: #fff;
    }
    .image-preview {
        width: 300px;
        min-height: 180px;
        border: 2px dashed #afeeee;
        margin-top: 15px;
        margin : 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
}
@media screen and (min-width: 361px) and (max-width: 414px) {
    label {
        margin-top: 1em;
        color: white;
        height: 40px;
        width: 120px;
        background-color: #03a9f4;
        position: absolute;
        font-size: 12px Poppins, sans-serif;
        margin-left: -4em;
        margin-bottom: 5rem;
        padding: 10px;
        border-radius: 10px;
        padding-top: 8px;
        padding-left: 20px;
        justify-content: center;
        align-items: center;
    }
    .btn-primary{
        margin-top:5rem;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        margin: 5rem auto;
        display: table;
        font-size: 18px;
        margin-bottom: 10px;
        border-color: #fff;
    }
    .image-preview {
        width: 300px;
        min-height: 180px;
        border: 2px dashed #afeeee;
        margin-top: 15px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
}
@media screen and (min-width: 415px) and (max-width: 600px) {
    label {
        margin-top: 1em;
        color: white;
        height: 40px;
        width: 120px;
        background-color: #03a9f4;
        position: absolute;
        font-size: 12px Poppins, sans-serif;
        margin-left: -4em;
        margin-bottom: 5rem;
        padding: 10px;
        border-radius: 10px;
        padding-top: 8px;
        padding-left: 20px;
        justify-content: center;
        align-items: center;
    }
    .btn-primary{
        margin-top:5rem;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        margin: 5rem auto;
        display: table;
        font-size: 18px;
        margin-bottom: 30px;
        border-color: #fff;
    }
    .image-preview {
        width: 300px;
        min-height: 180px;
        border: 2px dashed #afeeee;
        margin-top: 15px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
}
@media screen and (min-width: 601px) and  (max-width: 768px) {
    label {
        margin-top: 1em;
        color: white;
        height: 40px;
        width: 120px;
        background-color: #03a9f4;
        position: absolute;
        font-size: 12px Poppins, sans-serif;
        margin-left: -3.5em;
        margin-bottom: 5rem;
        padding: 10px;
        border-radius: 10px;
        padding-top: 8px;
        padding-left: 20px;
        justify-content: center;
        align-items: center;
    }
    .btn-primary{
        margin-top:5rem;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        margin: 5rem auto;
        display: table;
        font-size: 18px;
        margin-bottom: 30px;
        border-color: #fff;
    }
    .image-preview {
        width: 300px;
        min-height: 180px;
        border: 2px dashed #afeeee;
        margin-top: 15px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
}
@media screen and (min-width: 769px) and  (max-width: 991px) {
    label {
        margin-top: 1em;
        color: white;
        height: 40px;
        width: 120px;
        background-color: #03a9f4;
        position: absolute;
        font-size: 12px Poppins, sans-serif;
        margin-left: -3.5em;
        margin-bottom: 5rem;
        padding: 10px;
        border-radius: 10px;
        padding-top: 8px;
        padding-left: 20px;
        justify-content: center;
        align-items: center;
    }
    .btn-primary{
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        margin: 5rem auto;
        display: table;
        font-size: 18px;
        margin-bottom: 30px;
        border-color: #fff;
    }
    .image-preview {
        width: 300px;
        min-height: 180px;
        border: 2px dashed #afeeee;
        margin-top: 15px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
}
@media screen and (min-width: 992px){
    label {
        margin-top: 1em;
        color: white;
        height: 40px;
        width: 120px;
        background-color: #03a9f4;
        position: absolute;
        font-size: 12px Poppins, sans-serif;
        margin-bottom: 5rem;
        padding: 10px;
        border-radius: 10px;
        padding-top: 8px;
        padding-left: 20px;
        justify-content: center;
        align-items: center;
    }
    .btn-primary{
        margin-top:5rem;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        display: table;
        font-size: 18px;
        margin-bottom: 30px;
        border-color: #fff;
    }
    .image-preview {
        width: 300px;
        min-height: 200px;
        border: 2px dashed #afeeee;
        margin-top: 15px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
}

</style>
<section class="h-100 w-100 bg-white" style="box-sizing:border-box">
    <div class="container mx-auto position-relative" style="font-family: 'Popins,sans-serif';box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        <div style="text-align:center; margin-bottom:20px;">
            <h4 style="margin-top:20px">Silakan Unggah Bukti Pembayaran</h4>
        </div>
        <div class="row">
            <div class="contentt" style="width:100%">
                <div class="kolom1" style="width:50%;float:left">
                    <form action="{{ route('upload-pembayaran',$transaction->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="image-preview" id="imagePreview">
                            <img src="" id="imagePreview" alt="Image Preview" class="image-preview__image">
                                <span class="image-preview__default-text">
                                +</span>
                        </div>
                        <input type="file" name="bukti_pembayaran" id="inpFile">
                        <label for="inpFile">
                            <i class="fas fa-upload" aria-hidden="true"></i>&nbsp;
                                Pilih foto
                        </label>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
                <div class="kolom2" style="width: 40%;float:left;">
                    <h5>Cara Pembayaran</h5>
                    <br>
                    <h5>Panduan Pembayaran Sewa Kost</h5>
                    <div class="pembayaran">
                        <div class="section-title text-center">
                            <div class="card" style="width: 10rem;" style="box-shadow:0 2px 4px 0 rgba(14, 13, 13, 0.24)">
                                <img class="card-img-top" src="https://bimbel.ruangguru.com/hubfs/BNI.png" alt="Card image cap">
                                <div class="card-body">
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                              </div>
                            <li class="nav-item dropdown" style="list-style-type:none">
                                <p style="text-align:left;margin-bottom: 10px; font-size: 19px">Transfer Bank</p>
                                <a class="nav-link collapsed" data-toggle="collapse" data-target="#bni" style="margin-buttom:10px; text-align:left; background-color:white;box-shadow:0 2px 4px 0 rgba(95,95,95,0.24)" aria-expanded="false">
                                    <img src="https://bimbel.ruangguru.com/hubfs/BNI.png" style="width:55px; margin-bottom: 10px;margin-top: 10px;">
                                    <br>Bank Transfer BNI
                                </a>
                                <div class="collapse" id="bni" style="">
                                    <ol style="text-align:left; color: #4a4a4a">
                                        <li>Masukkan kartu pilih <b>bahasa</b>, dan masukkan PIN
                                            Anda.</li>
                                        <li>Pada menu utama, pilih <b>Transaksi Lainnya.</b></li>
                                        <li>Pilih <b>Transfer</b> dan pilih <b>ke rekening BNI.</b>
                                        </li>
                                        <li>Masukkan nominal transfer sesuai dengan total tagihan
                                            transaksi</li>
                                        <li><b>Simpan bukti pembayaran dan unggah bukti </b>pada
                                            halaman yang tersedia.</li>
                                    </ol>
                                </div>
                            </li>
                            <li class="nav-item dropdown" style="list-style-type:none; margin-top:20px">
                                <p style="text-align:left;margin-bottom: 10px; font-size: 19px">Dompet Digital</p>
                                <a class="nav-link button4 collapsed" data-toggle="collapse" data-target="#ovo" style="margin-buttom:10px; text-align:left; background-color:white;box-shadow:0 2px 4px 0 rgba(95,95,95,0.24)" aria-expanded="false">
                                    <img src="https://bimbel.ruangguru.com/hubfs/Logo%20OVO.png" style="width:55px; margin-bottom: 10px;margin-top: 10px;">
                                    <br>OVO
                                </a>
                                <div class="collapse" id="ovo" style="">
                                    <ol style="text-align:left; color: #4a4a4a">
                                        <li>Buka aplikasi pembayaran OVO Anda.</b></li>
                                        <li>Pilih menu <b>transfer.</b></li>
                                        <li>Masukan nominal sesuai tagihan.</li>
                                        <li>Pilih menu <b>transfer antar OVO.</b></li>
                                        <li>Masukan <b>nomor tujuan 08572839211 a.n Agam
                                        </li>
                                        <li>Periksa detail transaksi Anda pada aplikasi, lalu tap
                                            tombol <b>transfer.</b></li>
                                        <li>Transaksi Anda sudah selesai.</li>
                                    </ol>
                                </div>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('after-script')
    <script src="{{ asset('dropzone/dist/dropzone.js') }}"></script>
    <script type="text/javascript">
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
