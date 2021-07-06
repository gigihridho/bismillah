<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      @if(auth()->user()->hasRole('admin'))
      <div class="sidebar-brand">
        <a href="#">Admin Dashboard</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">AD</a>
      </div>
      @endif

      @if(auth()->user()->hasRole('user'))
      <div class="sidebar-brand">
        <a href="#">User Dashboard</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">UD</a>
      </div>
      @endif

      <ul class="sidebar-menu">
          @if(auth()->user()->hasRole('admin'))
          <li class="menu-header">Dashboard</li>
            <li class="nav-item">
                <a href="{{ route('admin-dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
          <li class="menu-header">Kamar</li>
            <li class="{{ (request()->is('admin/fasilitas*')) ? 'active' : '' }} ">
                <a href="{{ route('fasilitas.index') }}" class="nav-link">
                <i class="fas fa-columns"></i> <span>Fasilitas</span></a>
            </li>
            <li class="{{ (request()->is('admin/tipe*')) ? 'active' : '' }}">
                <a href="{{ route('tipe.index') }}" class="nav-link"><i class="fas fa-bed"></i> <span>Tipe Kamar</span></a>
            </li>
            <li class="nav-item dropdown">
                <li class="{{ (request()->is('admin/booking*')) ? 'active' : '' }}">
                    <a href="{{ route('booking.index') }}"><i class="fas fa-sign-in-alt"></i></i>Data Booking</a>
                </li>
            </li>
          <li class="menu-header">Transaksi
            <li class="{{ (request()->is('admin/transaksi*')) ? 'active' : '' }}">
                <a href="{{ route('transaksi') }}"><i class="fas fa-credit-card"></i>Laporan Transaksi</a>
            </li>
          </li>
          <li class="menu-header">User
            <li class="{{ (request()->is('admin/user*')) ? 'active' : '' }}">
                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-user"></i> <span>User</span></a>
            </li>
            <li class="{{ (request()->is('admin/reviews*')) ? 'active' : '' }}">
                <a href="{{ route('reviews.index') }}" class="nav-link"><i class="fas fa-book"></i><span>Review User</span></a>
            </li>
          </li>

          @endif

          @if(auth()->user()->hasRole('user'))
          <li class="menu-header">Dashboard</li>
            <li class="{{ (request()->is('user/user-transaksi*')) ? 'active' : '' }}">
                <a href="{{ route('user-transaksi') }}" class="nav-link"><i class="fas fa-sign-in-alt"></i> <span>Booking</span></a>
            </li>
            <li class="{{ (request()->is('user/review*')) ? 'active' : '' }}">
                <a href="{{ route('review-user') }}" class="nav-link"><i class="fas fa-comments"></i> <span>Review</span></a>
            </li>
            <li class="{{ (request()->is('user/profil-user*')) ? 'active' : '' }}">
                <a href="{{ route('profil-user') }}" class="nav-link"><i class="fas fa-user"></i> <span>Profil</span></a>
            </li>
            {{-- <li>
                <a href="{{ route('profil-user') }}" class="nav-link"><i class="fas fa-home"></i><span>User</span></a>
            </li> --}}
          @endif
    </aside>
  </div>
