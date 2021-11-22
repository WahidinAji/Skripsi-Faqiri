<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko Kafa 3</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @guest
    <li class="nav-item {{ (request()->is('/')) ? 'active' : null }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Login</span></a>
    </li>
    <li class="nav-item {{ (request()->is('items*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @else
    <li class="nav-item {{ (request()->is('transactions*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('transactions.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    {{-- Daftar Barang => Items --}}
    <li class="nav-item {{ (request()->is('items*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="fas fa-store"></i>
            <span>Daftar Barang</span></a>
    </li>
    {{-- Transaksi => Carts --}}
    <li class="nav-item {{ (request()->is('carts*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('carts.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Transaksi</span></a>
    </li>
    {{-- <li class="nav-item {{ (request()->is('reports*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('carts.index') }}">
            <i class="fas fa-grin-beam"></i>
            <span>Report Transactions</span></a>
    </li> --}}
    @endguest

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
