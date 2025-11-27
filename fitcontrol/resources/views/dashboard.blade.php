@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- ========================================== --}}
{{--                  ADMIN                     --}}
{{-- ========================================== --}}
@if(Auth::user()->rol == 'admin')
    <div class="card">
        <h2>Usuarios Registrados</h2>
        <canvas id="barChart"></canvas>
    </div>

    <div class="card">
        <h2>Progreso de Ventas</h2>
        <canvas id="lineChart"></canvas>
    </div>

    <div class="card">
        <h2>Distribución de Productos</h2>
        <canvas id="pieChart"></canvas>
    </div>

    <div class="card">
        <h2>Rendimiento Deportivo</h2>
        <canvas id="radarChart"></canvas>
    </div>
@endif



{{-- ========================================== --}}
{{--               ENTRENADOR                   --}}
{{-- ========================================== --}}


{{-- ========================================== --}}
{{--              DASHBOARD ENTRENADOR          --}}
{{-- ========================================== --}}
@if(Auth::user()->rol == 'entrenador')

<div class="card">
    <h2 class="text-xl font-bold">Bienvenido entrenador {{ Auth::user()->nombre }}</h2>
    <p class="text-gray-600">Aquí puedes gestionar tu equipo, entrenamientos y próximos partidos</p>
</div>

{{-- TARJETAS PRINCIPALES --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

    <div class="card bg-indigo-600 text-white">
        <h3 class="text-lg font-bold">Jugadores activos</h3>
        <p class="text-4xl font-bold mt-2">22</p>
        <p class="text-sm mt-1">Plantilla disponible</p>
    </div>

    <div class="card bg-green-600 text-white">
        <h3 class="text-lg font-bold">Entrenamientos del mes</h3>
        <p class="text-4xl font-bold mt-2">14</p>
        <p class="text-sm mt-1">Buen ritmo de preparación</p>
    </div>

    <div class="card bg-red-600 text-white">
        <h3 class="text-lg font-bold">Lesionados</h3>
        <p class="text-4xl font-bold mt-2">2</p>
        <p class="text-sm mt-1">Atención requerida</p>
    </div>

</div>

{{-- PRÓXIMO ENTRENAMIENTO --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Próximo Entrenamiento</h2>

    <div class="mt-3 p-4 bg-gray-100 rounded-lg flex items-center gap-5">
        <i class="fa-solid fa-dumbbell text-4xl text-indigo-600"></i>
        <div>
            <p><strong>Fecha:</strong> 29 de Noviembre</p>
            <p><strong>Hora:</strong> 3:30 PM</p>
            <p><strong>Tipo:</strong> Técnica + Resistencia</p>
            <p class="mt-2 text-indigo-600 font-semibold">Asegúrate de revisar la asistencia</p>
        </div>
    </div>
</div>

{{-- PRÓXIMO PARTIDO --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Próximo Partido</h2>

    <div class="mt-3 p-4 bg-gray-100 rounded-lg flex items-center gap-5">
        <i class="fa-solid fa-futbol text-4xl text-green-600"></i>
        <div>
            <p><strong>Rival:</strong> Dragones FC</p>
            <p><strong>Fecha:</strong> 02 de Diciembre</p>
            <p><strong>Hora:</strong> 7:00 PM</p>
            <p><strong>Estadio:</strong> Campo Olímpico</p>
            <p class="mt-2 text-green-700 font-semibold">Último partido: ganaste 3-1</p>
        </div>
    </div>
</div>

{{-- RENDIMIENTO GENERAL DEL EQUIPO --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Rendimiento del equipo</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4">

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">7.4</p>
            <p class="text-gray-600">Promedio general</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">85%</p>
            <p class="text-gray-600">Asistencia</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">14</p>
            <p class="text-gray-600">Goles anotados</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">8</p>
            <p class="text-gray-600">Goles recibidos</p>
        </div>

    </div>
</div>

{{-- LISTA RÁPIDA DE JUGADORES --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Plantilla actual</h2>

    <ul class="mt-4 space-y-3">

        <li class="flex items-center justify-between bg-gray-100 p-3 rounded-lg">
            <span class="font-semibold">Juan Pérez</span>
            <span class="text-green-600">Titular</span>
        </li>

        <li class="flex items-center justify-between bg-gray-100 p-3 rounded-lg">
            <span class="font-semibold">Carlos Gómez</span>
            <span class="text-yellow-600">Duda por lesión</span>
        </li>

        <li class="flex items-center justify-between bg-gray-100 p-3 rounded-lg">
            <span class="font-semibold">Luis Martínez</span>
            <span class="text-green-600">Titular</span>
        </li>

    </ul>
</div>

@endif



{{-- ========================================== --}}
{{--              DASHBOARD JUGADOR            --}}
{{-- ========================================== --}}
@if(Auth::user()->rol == 'jugador')

<div class="card">
    <h2>Bienvenido {{ Auth::user()->nombre }}</h2>
    <p class="text-gray-600">Este es tu panel personal. Revisa tu progreso, próximos eventos y objetivos.</p>
</div>

{{-- TARJETAS DE ESTADO --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="card bg-blue-500 text-white">
        <h3 class="text-lg font-bold">Asistencias este mes</h3>
        <p class="text-4xl font-bold mt-2">12</p>
        <p class="text-sm mt-1">Sigue así, vas excelente</p>
    </div>

    <div class="card bg-green-500 text-white">
        <h3 class="text-lg font-bold">Goles / Puntos</h3>
        <p class="text-4xl font-bold mt-2">5</p>
        <p class="text-sm mt-1">Estás mejorando tu rendimiento</p>
    </div>

    <div class="card bg-purple-500 text-white">
        <h3 class="text-lg font-bold">Entrenamientos completados</h3>
        <p class="text-4xl font-bold mt-2">8</p>
        <p class="text-sm mt-1">Tu disciplina destaca</p>
    </div>

</div>

{{-- PRÓXIMO ENTRENAMIENTO --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Próximo Entrenamiento</h2>
    <div class="mt-3 p-4 bg-gray-100 rounded-lg">
        <p><strong>Fecha:</strong> 28 de Noviembre</p>
        <p><strong>Hora:</strong> 4:00 PM</p>
        <p><strong>Ubicación:</strong> Cancha Norte</p>
        <p class="mt-2 text-green-600 font-semibold">¡No faltes! Este entrenamiento es clave para el próximo partido</p>
    </div>
</div>

{{-- PRÓXIMO PARTIDO --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Próximo Partido</h2>
    <div class="mt-3 p-4 bg-gray-100 rounded-lg flex items-center gap-5">
        <img src="{{ asset('img/futbol.png') }}" width="90">
        <div>
            <p><strong>Vs:</strong> Los Titanes</p>
            <p><strong>Fecha:</strong> 30 de Noviembre</p>
            <p><strong>Hora:</strong> 6:30 PM</p>
            <p><strong>Estadio:</strong> Plaza Central</p>
        </div>
    </div>
</div>

{{-- OBJETIVOS DEL JUGADOR --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Tus Objetivos</h2>

    <ul class="mt-3 space-y-2">
        <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500"></i> Mejorar tu velocidad (✔ 80% completado)
        </li>
        <li class="flex items-center gap-2">
            <i class="fa-solid fa-check text-green-500"></i> Aumentar resistencia (✔ 65% completado)
        </li>
        <li class="flex items-center gap-2">
            <i class="fa-solid fa-circle text-yellow-400"></i> Potenciar control del balón (en proceso)
        </li>
    </ul>
</div>

{{-- ESTADÍSTICAS RÁPIDAS --}}
<div class="card mt-6">
    <h2 class="text-xl font-bold">Estadísticas rápidas</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-3">

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">7.8</p>
            <p class="text-gray-600">Promedio rendimiento</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">15</p>
            <p class="text-gray-600">Partidos jugados</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">9</p>
            <p class="text-gray-600">Faltas cometidas</p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg text-center">
            <p class="text-3xl font-bold">3</p>
            <p class="text-gray-600">MVP obtenidos</p>
        </div>

    </div>
</div>

@endif


@endsection



@push('scripts')
<script>
/* =======================
   CHARTS PARA ADMIN
   ======================= */
@if(Auth::user()->rol == 'admin')
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
  type: 'bar',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
    datasets: [{
      label: 'Usuarios',
      data: [80, 60, 90, 40],
      backgroundColor: '#4CAF50'
    }]
  }
});

const lineCtx = document.getElementById('lineChart').getContext('2d');
new Chart(lineCtx, {
  type: 'line',
  data: {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
    datasets: [{
      label: 'Ventas',
      data: [50, 75, 60, 90, 100],
      borderColor: '#2196F3',
      fill: false,
      tension: 0.3
    }]
  }
});

const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
  type: 'pie',
  data: {
    labels: ['Electrónica', 'Ropa', 'Alimentos'],
    datasets: [{
      data: [35, 25, 40],
      backgroundColor: ['#4CAF50', '#2196F3', '#FFC107']
    }]
  }
});
@endif





/* =======================
   CHARTS PARA JUGADOR & ENTRENADOR
   ======================= */
const radarCtx = document.getElementById('radarChart')?.getContext('2d');
if(radarCtx){
    new Chart(radarCtx, {
      type: 'radar',
      data: {
        labels: ['Resistencia', 'Fuerza', 'Velocidad', 'Agilidad', 'Flexibilidad'],
        datasets: [{
          label: 'Mi Rendimiento',
          data: [80, 70, 90, 60, 75],
          backgroundColor: 'rgba(76, 175, 80, 0.2)',
          borderColor: '#4CAF50',
          pointBackgroundColor: '#4CAF50'
        }]
      },
      options: {
        elements: { line: { borderWidth: 3 } }
      }
    });
}


</script>
@endpush
