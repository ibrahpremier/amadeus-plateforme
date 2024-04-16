<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        @if (getLoggedUser()->role == 'chef_cellule')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link {{ request()->has('new') ? 'active' : '' }}">Nouvelles demandes</a>
            </li>
        @endif

        @if (getLoggedUser()->role == 'agent_ministere')
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html"
                class="nav-link {{ request()->routeIs('reservation.create') ? 'active' : '' }}">Nouvelle Reservation</a>
        </li>
        @endif
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link {{ request()->has('encours') ? 'active' : '' }}">Mission en cours</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#"
                class="nav-link {{ request()->routeIs('reservation.index') && !request()->has('encours') && !request()->has('new') ? 'active' : '' }}">Historique</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">2 Notification(s)</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-muted text-sm text-wrap">
                    Nouvelle soumission du ministere de la culture
                    <span class="float-right">04-04 à 10h00</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-muted text-sm text-wrap">
                    Nouvelle soumission du ministere de la culture
                    <span class="float-right">04-04 à 10h00</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Voir tout</a>
            </div>
        </li>
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}
        {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <h3 class="brand-text font-weight-light text-wrap">LOGO </h3>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <span class="fas fa-user-circle fa-2x"></span>
            </div>
            <div class="info">
                {{getLoggedUser()->nom.' '.getLoggedUser()->prenom}}
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- {{dd(request()->route())}} --}}
                <li class="nav-header">
                    <i class="nav-icon fas fa-th"></i>
                    MENU
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">

                    @if ((getLoggedUser()->role == 'chef_cellule') || (getLoggedUser()->role == 'agent_cellule'))
                        <a href="{{ route('reservation.index', 'new') }}"
                            class="nav-link {{ request()->has('new') ? 'active' : '' }}">
                            <p>
                                Nouvelles demandes
                                <i class="fas fa-angle-right right"></i>
                            </p>
                        </a>
                </li>
                <div class="dropdown-divider"></div>
                @endif

        @if (getLoggedUser()->role == 'agent_ministere')
                <li class="nav-item">
                    <a href="{{ route('reservation.create') }}"
                        class="nav-link {{ request()->routeIs('reservation.create') ? 'active' : '' }}">
                        <i class="fas fa-angle-right right"></i>
                        <p>Nouvelle reservation</p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
            @endif

                <li class="nav-item">
                    <a href="{{ route('reservation.index', 'encours') }}"
                        class="nav-link {{ request()->has('encours') ? 'active' : '' }}">
                        <p>
                            Missions terminées
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a href="{{ route('reservation.index', 'encours') }}"
                        class="nav-link {{ request()->has('encours') ? 'active' : '' }}">
                        <p>
                            Missions en cours
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a href="{{ route('reservation.index') }}"
                        class="nav-link {{ request()->routeIs('reservation.index') && !request()->has('encours') && !request()->has('new') ? 'active' : '' }}">
                        <p>
                            Tous
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <p>
                            <i class="fas fa-plus-circle left"></i>
                            Nouvel utilisateur
                            <i class="fas fa-angle-right right"></i>
                        </p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a href="{{ route('disconnect') }}" class="nav-link bg-dark">
                        <p>
                          <i class="fas fa-power-off left mr-2"></i>
                            Se déconnecter
                            {{-- <i class="fas fa-angle-right right"></i> --}}
                        </p>
                    </a>
                </li>
                <div class="dropdown-divider"></div>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
