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
                    <a href="{{ route('tipe.index') }}" class="nav-link">
                    <i class="fas fa-bed"></i> <span>Tipe Kamar</span></a>
                </li>
            <li class="menu-header">Data Transaksi
                <li class="{{ (request()->is('admin/booking/')) ? 'active' : '' }}">
                    <a href="{{ route('transaksi') }}" class="nav-link">
                        <i class="fas fa-sign-in-alt"></i><span>Data Transaksi</span></a>
                </li>
                {{-- <li class="{{ (request()->is('admin/booking/belum')) ? 'active' : '' }}">
                    <a href="{{ route('menunggu') }}"class="nav-link">
                        <i class="fas fa-minus-square"></i><span>Transaksi Menunggu</span></a>
                </li>
                <li class="{{ (request()->is('admin/booking/batal')) ? 'active' : '' }}">
                    <a href="{{ route('dibatalkan') }}"class="nav-link">
                        <i class="fas fa-minus-square"></i><span>Transaksi Dibatalkan</span></a>
                </li> --}}
            </li>
            <li class="menu-header">Keuangan
                <li class="{{ (request()->is('admin/pemasukan*')) ? 'active' : '' }}">
                    <a href="{{ route('pemasukan') }}"><i class="fas fa-credit-card"></i><span>Laporan Pemasukan</span></a>
                </li>
                <li class="{{ (request()->is('admin/pengeluaran*')) ? 'active' : '' }}">
                    <a href="{{ route('pengeluaran.index') }}"><i class="fas fa-receipt"></i><span>Laporan Pengeluaran</span></a>
                </li>
                {{-- <li class="{{ (request()->is('admin/invoice*')) ? 'active' : '' }}">
                    <a href="{{ route('invoice') }}"><i class="fas fa-file-invoice"></i><span>Invoice</span></a>
                </li> --}}
            </li>
            <li class="menu-header">User
                <li class="{{ (request()->is('admin/user*')) ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-user"></i><span>User</span></a>
                </li>
                <li class="{{ (request()->is('admin/reviews')) ? 'active' : '' }}">
                    <a href="{{ route('review') }}" class="nav-link"><i class="fas fa-book"></i><span>Review</span></a>
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
            @endif
    </aside>
</div>
