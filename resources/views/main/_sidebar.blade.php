<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light"><strong>{{ config('app.name') }}</strong></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->avatar() }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('auth.user.show', Auth::user()) }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="{{ route('auth.home') }}" class="nav-link {{ Request::is('auth/home') ? 'active' : false }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>

                <li class="nav-item has-treeview {{ Request::is('auth/user*') ? 'menu-open' : false }}">
                  <a href="{{ route('auth.user.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Pengguna Aplikasi
                    </p>
                  </a>
                    <ul class="nav nav-treeview">
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('auth.user.index') }}" class="nav-link {{ Request::is('auth/user') ? 'active' : false }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pengguna Terdaftar</p>
                        </a>
                      </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
