@php
  if (Auth::guard('admin')->check()) {
    $type = app('App\Http\Controllers\Admin\Auth\AdminAuthController')->admin_role();
  }
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">ChatBot</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              @if (Auth::check() || Auth::guard('admin')->check()) 
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::guard('admin')->check())
                      @if (Auth::guard('admin')->user()->avatar)
                        <img src="{{ asset('storage/'.Auth::guard('admin')->user()->avatar) }}" 
                          class="nav-user-img rounded-circle border border-dark" alt="...">
                      @else
                        <i class="bi bi-person border border-dark"></i>
                      @endif
                    @else 
                        @if (Auth::user()->avatar)
                          <img src="{{ asset('storage/'.Auth::user()->avatar) }}" 
                            class="nav-user-img rounded-circle border border-dark" alt="...">
                        @else
                          <i class="bi bi-person border border-dark"></i>
                        @endif
                    @endif
                  </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                      
                      @if (Auth::guard('admin')->check())
                        <li><a class="dropdown-item" href="{{ route($type.'.dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route($type.'.training.index') }}">Training</a></li>
                        <li>
                          <a class="dropdown-item" href="{{ route($type.'.logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">logout</a>
                          <form method="POST" action="{{ route($type.'.logout') }}" id="logout-form">
                            @csrf
                          </form>
                        </li>
                      @else
                        <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.message-history') }}">Message History</a></li>
                        <li>
                          <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">logout</a>
                          <form method="POST" action="{{ route('user.logout') }}" id="logout-form">
                            @csrf
                          </form>
                        </li>
                      @endif
                  </ul>
                </li>
              @else
                <li class="nav-item">
                  <a class="nav-link btn btn-success text-white px-4 py-1" aria-current="page" href="{{ route('login') }}">Login</a>
                </li>
              @endif
            </ul>
        </div>
    </div>
</nav>