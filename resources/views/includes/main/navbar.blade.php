<!-- ================ header section start ================= -->
<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <!-- <a class="navbar-brand logo_h" href="{{ route('home') }}"><img src="img/logo.png" alt=""></a> -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <div id="logo">
                <a href="{{ route('home') }}"><img src="{{ url('/seapalace/img/Logo.png')}}" alt="" title="" style="max-width: 50%"  /></a>
              </div>
          </div>

          <ul class="nav navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            @guest
            <li class="nav-item">
                <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign In</a>
            </li>
            @endguest
          </ul>
          &nbsp;
          <ul class="nav navbar-nav">
            @auth
            <!--Desktop Menu-->
            <ul class="navbar-nav d-none d-lg-flex">
             <li class="nav-item dropdown">
               <a href="#" class="nav-link" id="navbar-dropdown" role="button" data-toggle="dropdown">
                 Hi, {{ Auth::user()->name }}
               </a>
               <div class="dropdown-menu">
                 @if(auth()->user()->hasRole('user'))
                 <a href="{{ route('user-transaksi') }}" class="dropdown-item"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
                    <div class="dropdown-divider"></div>
                    <a
                    href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item text-danger"
                    >
                    <i class="fas fa-sign-out-alt text-danger"></i> <span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </a>
                 @endif

                 @if(auth()->user()->hasRole('admin'))
                 <a href="{{ route('admin-dashboard') }}" class="dropdown-item"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                    <div class="dropdown-divider"></div>
                    <a
                    href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item text-danger"
                    >
                    <i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
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
