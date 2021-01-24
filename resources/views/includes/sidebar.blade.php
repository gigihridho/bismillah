<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Dashboard</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">Ds</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
            <li class="nav-item active">
                <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
          <li class="menu-header">Kamar</li>
            <li class="nav-item">
                <a href="{{ route('fasilitas.index') }}" class="nav-link"><i class="fas fa-columns"></i> <span>Fasilitas</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tipe.index') }}" class="nav-link"><i class="fas fa-hamburger"></i> <span>Tipe Kamar</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kamar.index') }}" class="nav-link"><i class="fas fa-bed"></i> <span>Kamar</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('gallery.index') }}" class="nav-link"><i class="fas fa-camera"></i> <span>Gallery</span></a>
            </li>
          <li class="menu-header">Transaksi
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-money-bill"></i> <span>Transaksi</span></a>
            </li>
          </li>
          <li class="menu-header">User
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-user"></i> <span>User</span></a>
            </li>
          </li>
    </aside>
  </div>
