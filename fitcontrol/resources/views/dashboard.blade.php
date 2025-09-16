@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

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

@endsection

@push('scripts')
<script>
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

const radarCtx = document.getElementById('radarChart').getContext('2d');
new Chart(radarCtx, {
  type: 'radar',
  data: {
    labels: ['Resistencia', 'Fuerza', 'Velocidad', 'Agilidad', 'Flexibilidad'],
    datasets: [{
      label: 'Jugador 1',
      data: [80, 70, 90, 60, 75],
      backgroundColor: 'rgba(76, 175, 80, 0.2)',
      borderColor: '#4CAF50',
      pointBackgroundColor: '#4CAF50'
    }, {
      label: 'Jugador 2',
      data: [60, 85, 70, 80, 65],
      backgroundColor: 'rgba(33, 150, 243, 0.2)',
      borderColor: '#2196F3',
      pointBackgroundColor: '#2196F3'
    }]
  },
  options: {
    elements: { line: { borderWidth: 3 } }
  }
});
</script>
@endpush
