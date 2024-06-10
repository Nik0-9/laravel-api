<header class="shadow-sm d-flex align-items-center justify-content-end">
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white">
    
    <div class="container-fluid">
      <ul class="navbar-nav ms-auto d-flex flex-row">

        <li class="nav-item">
          <a
            class="nav-link me-3 me-lg-0"
            href="#">
            <i class="fas fa-bell"></i>
            <span class="badge rounded-pill badge-notification bg-danger">1</span>
          </a>

        </li>

        <li class="nav-item me-3 me-lg-0">
          <a class="nav-link" href="#">
            <i class="fab fa-github"></i>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link me-3 me-lg-0" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" title="Logout">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="userProfile" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle" src="/img/user.webp">
            </a>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

</header>