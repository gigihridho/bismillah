<ul class="nav nav-tabs">
    <li class="nav-item {{ (request()->is('admin/booking/')) ? 'active' : '' }}" style="width: 247px;">
      <a class="nav-link" href="{{ route('transaksi') }}">Semua</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/belum')) ? 'active' : '' }}" style="width: 247px;">
      <a class="nav-link" href="{{ route('selesai') }}">Selesai</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/sudah')) ? 'active' : '' }}" style="width: 247px;">
      <a class="nav-link" href="{{ route('menunggu') }}">Menunggu</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/batal')) ? 'active' : '' }}" style="width: 247px;">
      <a class="nav-link" href="{{ route('dibatalkan') }}">Dibatalkan</a>
    </li>
</ul>
