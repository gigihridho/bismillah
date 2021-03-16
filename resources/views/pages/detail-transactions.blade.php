<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Kost Griya Kenyo</title>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  @include('includes.main.style')
  @include('includes.main.styledetail');
</head>
<body>
	@include('includes.main.navbar')
    <main class="site-main">
        <div class="page-content page-details">
            <section class="kost-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Detail Transaksi
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>
            <section class="store-gallery mb-3" id="gallery">
            </section>
              <div class="store-details-container" data-aos="fade-up">
                <section class="store-heading">
                  <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <img src="{{ url('assets/img/explore1.png') }}" class="w-100 mb-3" alt="">
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="transactions-title">Name</div>
                                    <div class="transactions-subtitle">Budi</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transactions-title">Kamar</div>
                                    <div class="transactions-subtitle">Kamar K1L1</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transactions-title">Tanggal Pesan</div>
                                    <div class="transactions-subtitle">20-03-2021</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transactions-title">Harga</div>
                                    <div class="transactions-subtitle">Rp 90000</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transactions-title">Tanggal Masuk</div>
                                    <div class="transactions-subtitle">20-03-2021</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="transactions-title">Tanggal Keluar</div>
                                    <div class="transactions-subtitle">20-04-2021</div>
                                </div>
                                <button type="submit" class="btn btn-success px-5 text-white mb-3">
                                    Pesan Kamar
                                </button>
                            </div>
                        </div>
                    </div>
                  </div>
                </section>
              </div>
        </div>
    </main>

@include('includes.main.footer')


@include('includes.main.script')
@push('addon-script')
<script src="{{ url('/vue/vue.js') }}"></script>
<script src="{{ url('/js/moment.min.js') }}"></script>
@endpush

</body>
</html>
