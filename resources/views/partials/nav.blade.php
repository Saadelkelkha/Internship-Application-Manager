<nav class="navbar navbar-expand-sm navbar-light bg-light ps-3 pe-3 w-100" style="position: fixed; top: 0; left: 0; right: 0;max-height: 50px;z-index:1000">
  <a class="navbar-brand h-100" href="{{route('home')}}">
    <img class="img h-100" src="{{ asset('storage/logo.png') }}" alt="Logo" style="max-height: 50px; object-fit: cover;">
  </a>
  <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">Accueil</a>
      </li>
    </ul>
    @if(Auth::guard('etudiants')->user())
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" style="margin-right: 80px" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::guard('etudiants')->user()->prenom }} {{ Auth::guard('etudiants')->user()->nom }}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="{{route('login.logout')}}">Deconnexion</a>
        </div>
      </div>
    @endif
  </div>
</nav>
