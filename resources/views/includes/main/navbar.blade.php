<!-- ================ header section start ================= -->
<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <!-- <a class="navbar-brand logo_h" href="{{ route('home') }}"><img src="img/logo.png" alt=""></a> -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <div id="logo">
                <a href="{{ route('home') }}"><img src="{{ url('/seapalace/img/Logo.png')}}" alt="" title="" style="max-width: 50%"  /></a>
              </div>
          </div>

          <ul class="nav navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
            @guest
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Daftar</a>
            </li>
            <li class="nav-item mx-auto">
                <a href="{{ route('login') }}" class="btn btn-success px-4 nav-link text-white" style="border-radius: 20px">Masuk</a>
            </li>
            @endguest
          </ul>
          &nbsp;
          &nbsp;
          &nbsp;
          <ul class="nav navbar-nav">
            @auth
            <!--Desktop Menu-->
            <ul class="nav navbar-nav d-none d-lg-flex">
             <li class="nav-item dropdown">
               <a href="#" class="nav-link" id="navbar-dropdown" role="button" data-toggle="dropdown" style="margin-right: 4px;">
                 Hi, {{ Auth::user()->name }}
               </a>
               <div class="dropdown-menu">
                 @if(auth()->user()->hasRole('user'))
                 <a href="{{ route('change-profil-user') }}" class="dropdown-item">Profil</a>
                 <a href="{{ route('user-transaksi') }}" class="dropdown-item"><span>Transaksi</span></a>
                    <div class="dropdown-divider"></div>
                <a
                href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="dropdown-item text-danger"
                >
                <span>Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </a>
                 @endif

                 @if(auth()->user()->hasRole('admin'))
                 <a href="{{ route('admin-dashboard') }}" class="dropdown-item"><span>Dashboard</span></a>
                    <div class="dropdown-divider"></div>
                    <a
                    href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item text-danger"
                    >
                    <span>Keluar</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </a>
                 @endif
               </div>
             </li>
             @endauth
          </ul>
        </div>
      </nav>
    </div>
  </header>
	<!-- ================ header section end ================= -->
