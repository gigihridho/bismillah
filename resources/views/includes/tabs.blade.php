<style type=text/css>
    li {
        width: 247px;
    }
    .nav-tabs .nav-item.active {
        color: blue;
    }

    .nav-tabs .nav-item .nav-link {
        color: #000;
    }

</style>
<ul class="nav nav-tabs">
    <li class="nav-item {{ (request()->is('admin/booking/')) ? 'active' : '' }}" style="color: #6777af">
      <a class="nav-link" href="{{ route('transaksi') }}" style="text-align:center;">Semua</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/belum')) ? 'active' : '' }}" >
      <a class="nav-link" href="{{ route('selesai') }}" style="text-align:center;">Selesai</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/sudah')) ? 'active' : '' }}" >
      <a class="nav-link" href="{{ route('menunggu') }}" style="text-align:center;">Menunggu</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/batal')) ? 'active' : '' }}" >
      <a class="nav-link" href="{{ route('dibatalkan') }}" style="text-align:center;">Dibatalkan</a>
    </li>
</ul>
