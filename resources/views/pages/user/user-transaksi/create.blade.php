@extends('layouts.admin')

@section('title')
    Perpanjangan Sewa
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
    width: 225px;
    min-height: 150px;
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
            <h1>@yield('title')</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">@yield('title')</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                    <div class="card">
                    <div class="card-header">
                        <h4>Perpanjangan sewa</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('save-lanjut-sewa') }}" id="form-sewa" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="transaction" value="{{ $transaction }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Durasi</label>
                                    <select name="duration" id="duration" class="form-control">
                                        <option value="1">1 Bulan</option>
                                        <option value="6">6 Bulan</option>
                                        <option value="12">1 Tahun</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Harga</label>
                                    <input type="hidden" name="total" id="total" value="{{ $room_type->price }}">
                                    <input type="text" name="total_price" id="total_price" class="form-control" readonly value="{{ number_format($room_type->price) }}">
                                </div>
                            </div>
                        </div>
                        <div class="image-preview" id="imagePreview">
                            <img src="" id="imagePreview" alt="Image Preview" class="image-preview__image">
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
                            <div class="row" style="margin-top: 3rem">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary px-5" style="padding: 8px 16px">
                                        Simpan Data
                                    </button>
                                </div>
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
<script>
    let price = {!! $room_type->price !!}
    let selectedDuration = $("#duration");
    selectedDuration.on('change', (event) => {
        let duration = event.target.value;
        let total = updatePrice(duration, price);

        $("#total").val(total);
        $("#total_price").val(total.toLocaleString());
    })

    function updatePrice(duration, price) {
        let total_price = 0 ;

        if (duration == 1){
            total_price = duration * price;
        } else if (duration == 6){
            total_price = duration * price - (0.5 * price);
        } else if(duration == 12){
            total_price = duration * price - (1 * price);
        }
        return total_price;
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
