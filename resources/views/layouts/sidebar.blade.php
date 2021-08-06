<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @guest
    <li class="nav-item {{ (request()->is('/')) ? 'active' : null }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Login</span></a>
    </li>
    <li class="nav-item {{ (request()->is('itemss*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @else
    <li class="nav-item {{ (request()->is('items*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    {{-- <li class="nav-item {{ (request()->is('admin/budgets*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('budgets.index') }}">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Budgets</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/teams*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('teams.index') }}">
            <i class="fas fa-grin-beam"></i>
            <span>Teams</span></a>
    </li>
    <li class="nav-item {{ (request()->is('admin/projects*')) ? 'active' : null }}">
        <a class="nav-link" href="{{ route('projects.index') }}">
            <i class="fas fa-tasks"></i>
            <span>Projects</span></a>
    </li> --}}
    @endguest

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
