<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FitControl | @yield('title')</title>
  <link rel="icon" type="img/userrm.png" href="img/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<script src="https://cdn.tailwindcss.com"></script>

@stack('styles')

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <div>
      <div class="header">
        <img src="img/userrm.png" alt="usuario">
        <div class="info">
          <strong>Berick Zambrano</strong><br>
          Administrador
        </div>
      </div>
      <img height="170px" width="170px" src="{{ asset('img/logo.png') }}" alt="Logo de FitControl">

      <div class="menu">
<a href="{{ route('dashboard') }}" class="menu-item active">
    <i class="fas fa-home"></i><span>Inicio</span>
</a>
        <div class="menu-item has-submenu">
  <i class="fas fa-chart-bar"></i>
  <span>Tablas <i class="fas fa-chevron-down"></i></span>
 <div class="submenu">
    <a href="{{ route('usuarios.index') }}" class="submenu-item"><i class="fa-solid fa-user"></i> Usuarios</a>
    <a href="{{ route('notificaciones.index') }}" class="submenu-item"><i class="fa-solid fa-bell"></i> Notificaciones</a>
    <a href="{{ route('historial.index') }}" class="submenu-item"><i class="fa-solid fa-file-medical"></i> Historial Médico</a>
    <a href="{{ route('equipo.index') }}" class="submenu-item"><i class="fa-solid fa-users"></i> Equipo</a>
    <a href="{{ route('torneo.index') }}" class="submenu-item"><i class="fa-solid fa-trophy"></i> Torneo</a>
    <a href="{{ route('partido.index') }}" class="submenu-item"><i class="fa-solid fa-futbol"></i> Partido</a>
    <a href="{{ route('estadistica_partido.index') }}" class="submenu-item"><i class="fa-solid fa-chart-line"></i> Estadistica Partido</a>
    <a href="{{ route('entrenamiento.index') }}" class="submenu-item"><i class="fa-solid fa-dumbbell"></i> Entrenamiento</a>
    <a href="{{ route('rendimiento.index') }}" class="submenu-item"><i class="fa-solid fa-award"></i> Rendimiento</a>
    <a href="{{ route('pago.index') }}" class="submenu-item"><i class="fa-solid fa-money-bill-wave"></i> Pago</a>
    <a href="{{ route('asistencia_entrenamiento.index') }}" class="submenu-item"><i class="fa-solid fa-calendar-check"></i> Asistencia Entrenamiento</a>
    <a href="{{ route('inscripcion.index') }}" class="submenu-item"><i class="fa-solid fa-pen-to-square"></i> Inscripcion</a>
    <a href="{{ route('inscripcion_equipo.index') }}" class="submenu-item"><i class="fa-solid fa-users-gear"></i> Inscripcion Equipo</a>
</div>

</div>

<a href="{{ route('calendario.index') }}" class="menu-item ">
    <i class="fas fa-bell"></i><span>Calendario</span>
</a>

<a href="{{ route('reportes') }}" class="menu-item ">
<i class="fas fa-file-alt"></i><span>Reportes</span>
</a>      </div>
    </div>

    <div class="bottom">
<a href="{{ route('logout') }}" class="menu-item">
    <i class="fas fa-sign-out-alt"></i><span>Cerrar sesión</span>
</a>      <div class="toggle-theme">
        <i class="fas fa-moon"></i><span>Modo Oscuro</span>
        <label class="switch">
          <input type="checkbox" id="theme-toggle">
        </label>
      </div>
      <div class="toggle-sidebar">
        <i class="fas fa-angle-double-left" id="collapse-icon"></i><span>Colapsar</span>
      </div>
    </div>
  </div>

  <div class="main-content">
    @yield('content')
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
  @stack('scripts')
</body>
</html>
