<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Peluquería Estilo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Links de navegación principales -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('citas.index') }}">Citas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sorteo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reseñas</a>
        </li>
      </ul>

      <!-- Sección de usuario y logout -->
      <ul class="navbar-nav ms-auto">
        @if (Auth::check())
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }} <!-- Mostrar nombre del usuario -->
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                </form>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
