<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FitControl | @yield('title')</title>
  <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100">

  <!-- Sidebar -->
  <div class="flex">
    <aside class="w-64 bg-white shadow-lg h-screen p-6 flex flex-col justify-between">
      <div>
        <!-- Perfil -->
        <div class="text-center mb-6">
          <img src="{{ asset('img/userrm.png') }}" alt="Jugador" class="w-24 h-24 mx-auto rounded-full">
       <div class="info">
  <strong> Bienvenido, {{ Auth::user()->nombre }}</strong><br>
  {{ ucfirst(Auth::user()->rol) }}
</div>

        </div>

        <!-- Menú -->
        <nav class="mt-8">
          <ul>
            <li class="mb-4">
              <span class="flex items-center p-2 rounded hover:bg-gray-200 cursor-pointer">
                <i class="fas fa-home mr-3"></i> Inicio
              </span>
            </li>
            <li class="mb-4">
              <span class="flex items-center p-2 rounded hover:bg-gray-200 cursor-pointer">
                <i class="fas fa-dumbbell mr-3"></i> Entrenamientos
              </span>
            </li>
            <li class="mb-4">
              <span class="flex items-center p-2 rounded hover:bg-gray-200 cursor-pointer">
                <i class="fas fa-chart-line mr-3"></i> Estadísticas
              </span>
            </li>
            <li class="mb-4">
              <span class="flex items-center p-2 rounded hover:bg-gray-200 cursor-pointer">
                <i class="fas fa-calendar mr-3"></i> Calendario
              </span>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Footer -->
      <div class="mt-6">
        <a href="{{ route('logout') }}" class="flex items-center p-2 rounded hover:bg-gray-200">
          <i class="fas fa-sign-out-alt mr-3"></i> Cerrar sesión
        </a>
      </div>
    </aside>

    <!-- Contenido principal -->
    <main class="flex-1 p-10">
      @yield('content')
    </main>
  </div>

</body>
</html>
