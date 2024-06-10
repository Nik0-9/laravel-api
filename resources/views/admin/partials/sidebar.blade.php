<nav id="sidebar" class="bg-dark navbar-dark ">
  <a href="/" class="nav-link text-white">
      <div class="d-flex align-items-center p-2">
      <i class="fa-solid fa-square-rss fs-1 me-1"></i>
      <h2>MyProjects</h2>
    </div>
    </a>
    
    <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-white {{Route::currentRouteName() == 'admin.dashboard' ? 'active' : ''}}" href="{{route('admin.dashboard')}}"><i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i>Dasboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white {{Route::currentRouteName() == 'admin.projects' ? 'active' : ''}}" href="{{route('admin.projects.index')}}"> <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white {{Route::currentRouteName() == 'admin.types' ? 'active' : ''}}" href="{{route('admin.types.index')}}"> <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>types</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  text-white {{Route::currentRouteName() == 'admin.tecnologies' ? 'active' : ''}}" href="{{route('admin.technologies.index')}}"> <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>Tecnologies</a>
        </li>

      </ul>
    </nav>