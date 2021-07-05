@extends('layouts.fe')

@section('title')
    Kost Griyo Kenyo
@endsection

@section('content')
<section class="h-100 w-100 bg-white" style="box-sizing: border-box">
    <div class="detail-1 container mx-auto p-0  position-relative detail-content" style="font-family: 'Poppins', sans-serif">
        <div class="row">
            <nav aria-label="breadcrumb" class="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
        </div>


    <div class="kost-gallery" id="gallery">
        <div class="container">
            <div class="row">
                @php $incrementRoomType = 0 @endphp
                @forelse ($room_types as $room_type)
                <div class="col-lg-8">
                    <img src="{{Storage::url($room_type->photo) }}" alt="" width="70%">
                </div>
                @empty
                <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                  Tipe Kamar Tidak Ditemukan
                </div>
                @endforelse
                <div class="col-lg-4">
                    <div class="card-body shadow-lg p-3 mb-5 bg-white rounde">
                        <form action="{{ route('booking',$room_type->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="booking_validation" type="hidden" value="0">
                        <div class="form-group">
                            <label for="date">Pilih tanggal masuk</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                    <input type="date" class="form-control" id="datepicker" name="arrival_date" placeholder="DD/MM/YYYY">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="duration">Durasi Sewa</label>
                            <select name="duration" id="duration" class="form-control">
                                <option value="1">1 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">1 Tahun</option>
                            </select>
                        </div>
                        <br>
                        <br>
                        @auth
                        <button type="submit" class="btn btn-success px-5 text-white btn-block mb-3">
                            Pesan Kamar
                        </button>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                            Masuk Untuk Pesan
                        </a>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="kost-detail">
        <section class="kost-heading">
            <div class="container">
                <div class="row">
                    @php
                    $incrementRoomTypes = 0
                    @endphp
                    @forelse ($room_types as $room_type)
                    <div class="col-lg-8">
                        <h4>Tipe Kamar</h4>
                        <input type="hidden" name="id" value="{{ $room_type->room }}">
                        <div class="owner">{{ $room_type->name }}</div>
                        <div class="price" style="color: red">Rp {{ number_format($room_type->price) }}/Bulan</div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        Tipe Kamar Tidak Ditemukan
                    </div>
                    @endforelse
                </div>
                <br>
                <div class="row">
                    @php $incrementRoomType = 0 @endphp
                    <div class="col-md-6">
                        <h5>Fasilitas</h5>
                        <p>Fasilitas yang tersedia</p>
                        @forelse ($room_type->facilities as $facility)
                        <div class="card-body">
                            <ul>
                                <p>-> {{ $facility->name }}</p>
                            </ul>
                        </div>
                        @empty
                        <div class="col-12 text-left" data-aos="fade-up" data-aos-delay="100">
                            Data Fasilitas Tidak Ditemukan
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            </div>
        </section>
    </div>
</div>
</section>
@endsection
