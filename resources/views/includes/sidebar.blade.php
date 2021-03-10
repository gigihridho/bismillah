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
                <a href="{{ route('admin-dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
          <li class="menu-header">Kamar</li>
            <li class="{{ (request()->is('admin/fasilitas*')) ? 'active' : '' }} ">
                <a href="{{ route('fasilitas.index') }}" class="nav-link">
                <i class="fas fa-columns"></i> <span>Fasilitas</span></a>
            </li>
            <li class="{{ (request()->is('admin/tipe*')) ? 'active' : '' }}nav-item">
                <a href="{{ route('tipe.index') }}" class="nav-link"><i class="fas fa-hamburger"></i> <span>Tipe Kamar</span></a>
            </li>
            <li class="{{ (request()->is('admin/kamar*')) ? 'active' : '' }}">
                <a href="{{ route('kamar.index') }}" class="nav-link"><i class="fas fa-bed"></i> <span>Kamar</span></a>
            </li>
            <li class="{{ (request()->is('admin/gallery*')) ? 'active' : '' }}">
                <a href="{{ route('gallery.index') }}" class="nav-link"><i class="fas fa-camera"></i> <span>Gallery</span></a>
            </li>
          <li class="menu-header">Transaksi
            <li class="{{ (request()->is('admin/transaksi*')) ? 'active' : '' }}">
                <a href="{{ route('transaksi.index') }}" class="nav-link"><i class="fas fa-money-bill"></i> <span>Transaksi</span></a>
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
                <a href="{{ route('user-transaksi.index') }}" class="nav-link"><i class="fas fa-money-bill"></i> <span>Transaksi</span></a>
            </li>
            <li class="{{ (request()->is('user/review*')) ? 'active' : '' }}">
                <a href="{{ route('review-user') }}" class="nav-link"><i class="fas fa-comments"></i> <span>Review</span></a>
            </li>
          @endif
    </aside>
  </div>
