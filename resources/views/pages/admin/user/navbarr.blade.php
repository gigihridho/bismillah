<div class="content-header-2">
    <div class="btn-group btn-group-toggle"  style="float:right">
        <a href="{{ route('user-aktif') }}" class="btn btn-primary {{ request()->is('admin/user*') ? 'active': ''}}"  >AKTIF</a>
        <a href="{{ route('user-tidak-aktif') }}" class="btn btn-primary {{  request()->is('admin/user*') ? 'active': ''}}">TIDAK AKTIF</a>
    </div>
</div>
