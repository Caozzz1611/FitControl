@extends('layouts.app')

@section('title', 'Dashboard Jugador')

@section('content')
<h1 class="text-3xl font-bold mb-6">Bienvenido, Jugador</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

  <!-- Card Entrenamientos -->
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-2">Entrenamientos Próximos</h2>
    <p class="text-gray-600">Aquí verás los entrenamientos asignados para tu equipo.</p>
    <div class="mt-4 bg-gray-100 p-4 rounded">
      <p>Fecha: 22/09/2025</p>
      <p>Hora: 10:00 AM</p>
      <p>Ubicación: Campo Principal</p>
    </div>
  </div>

  <!-- Card Estadísticas -->
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-2">Estadísticas Personales</h2>
    <p class="text-gray-600">Revisa tu rendimiento en partidos y entrenamientos.</p>
    <div class="mt-4 bg-gray-100 p-4 rounded">
      <p>Goles: 5</p>
      <p>Asistencias: 3</p>
      <p>Asistencia a entrenamientos: 90%</p>
    </div>
  </div>

  <!-- Card Próximos Partidos -->
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-2">Próximos Partidos</h2>
    <p class="text-gray-600">Mira los partidos que se acercan para tu equipo.</p>
    <div class="mt-4 bg-gray-100 p-4 rounded">
      <p>Rival: Equipo A</p>
      <p>Fecha: 25/09/2025</p>
      <p>Hora: 3:00 PM</p>
    </div>
  </div>

</div>
@endsection
