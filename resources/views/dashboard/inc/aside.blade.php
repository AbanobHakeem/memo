       <!-- Main Sidebar Container -->
       <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard.index') }}" class="brand-link">
            <img src="{{ asset('control') }}/dist//img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ Storage::url('public/admins/') . \Auth::user()->avatar }}"
                        class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ \Auth::user()->name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" id="fillter-side" type="search"
                        placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @can('dashboard.index')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}"
                            class="nav-link @if (request()->routeIs('dashboard.index')) active @endif ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>
                    @endcan

                    @can(['dashboard.admins.index','dashboard.users.index','dashboard.permissions.index','dashboard.roles.index'])
                    <li class="nav-item  @if (request()->routeIs('dashboard.admin*') or request()->routeIs('dashboard.user*') or request()->routeIs('dashboard.roles*') or request()->routeIs('dashboard.permissions*')) menu-open @endif ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <p>
                                Members
                                <i class="fas fa-angle-left right"></i>
                                <span
                                    class="badge badge-success right">{{ \App\Models\User::Active()->count() + \App\Models\Admin::Active()->count() }}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('dashboard.users.index')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.users.index') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.users*')) active @endif ">
                                    <i class="fas fa-user"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard.admins.index')
                             <li class="nav-item">
                                <a href="{{ route('dashboard.admins.index') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.admins*')) active @endif ">
                                    <i class="fas fa-user-cog"></i>
                                    <p>Admins</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard.roles.index')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.roles.index') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.roles*')) active @endif ">
                                    <i class="fas fa-user-tag"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard.permissions.index')    
                            <li class="nav-item">
                                <a href="{{ route('dashboard.permissions.index') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.permissions*')) active @endif ">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Permission</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can(['dashboard.authours.index','dashboard.authours.create','dashboard.authours.edit','dashboard.authours.destroy'])
                    <li class="nav-item  @if (request()->routeIs('dashboard.authours*')) menu-open @endif ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-pen-nib"></i>
                            <p> Authours
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-warning right">{{ \App\Models\Authour::Active()->count() }}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('dashboard.authours.index')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.authours.index') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.authours.index')) active @endif ">
                                    <i class="fas fa-list"></i>
                                    <p>View authours</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard.authours.create')    
                            <li class="nav-item">
                                <a href="{{ route('dashboard.authours.create') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.authours.create')) active @endif ">
                                    <i class="fas fa-plus-circle"></i>
                                    <p>Add authour</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can(['dashboard.publishers.index','dashboard.publishers.create','dashboard.publishers.edit','dashboard.publishers.destroy'])
                    <li class="nav-item  @if (request()->routeIs('dashboard.publishers*')) menu-open @endif ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-swatchbook"></i>
                            <p>
                                Publishers
                                <i class="fas fa-angle-left right"></i>
                                <span
                                    class="badge badge-warning right">{{ \App\Models\Publisher::Active()->count() }}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('dashboard.publishers.index')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.publishers.index') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.publishers.index')) active @endif ">
                                    <i class="fas fa-list"></i>
                                    <p>View Publishers</p>
                                </a>
                            </li>
                            @endcan
 
                            @can('dashboard.publishers.create')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.publishers.create') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.publishers.create')) active @endif ">
                                    <i class="fas fa-plus-circle"></i>
                                    <p>Add Publisher</p>
                                </a>
                            </li>
                            @endcan
                            
                        </ul>
                    </li>
                    @endcan

                    @can(['dashboard.languages.index','dashboard.languages.create','dashboard.languages.edit','dashboard.languages.destroy'])
                    <li class="nav-item  @if (request()->routeIs('dashboard.languages*')) menu-open @endif ">
                        <a href="#" class="nav-link">
                            <i class="fas fa-globe-africa"></i>
                            <p>
                                Languages
                                <i class="fas fa-angle-left right"></i>
                                <span
                                    class="badge badge-info right">{{ \App\Models\Language::Active()->count() }}</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('dashboard.languages.index')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.languages.index') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.languages.index')) active @endif ">
                                    <i class="fas fa-list"></i>
                                    <p>View Langs</p>
                                </a>
                            </li>
                            @endcan
                            @can('dashboard.languages.create')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.languages.create') }}"
                                    class="nav-link @if (request()->routeIs('dashboard.languages.create')) active @endif ">
                                    <i class="fas fa-plus-circle"></i>
                                    <p>Add new</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('dashboard.translation.index')
                    <li class="nav-item  @if (request()->routeIs('dashboard.translation*')) active @endif ">
                        <a href="{{ route('dashboard.translation.index') }}" class="nav-link">
                            <i class="fas fa-language"></i>
                            <p>
                                Translations
                            </p>
                        </a>

                    </li>
                    @endcan
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
