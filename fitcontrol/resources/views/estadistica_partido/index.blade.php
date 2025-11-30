@extends('layouts.app')

@section('title', 'Estadísticas de Partidos')

@section('content')

<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notyf = new Notyf({
            duration: 3000,
            position: { x: 'right', y: 'bottom' },
            ripple: true,
        });

        @if(session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    });
</script>

<div class="card">
    <h2 class="h2L">Listado de Estadísticas de Partidos</h2>

   <form action="{{ route('estadistica_partido.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Jugador -->
    <input type="text" name="usuario" class="form-control" 
           placeholder="Buscar por jugador" value="{{ request('usuario') }}">

    <!-- Rival -->
    <input type="text" name="rival" class="form-control" 
           placeholder="Buscar por rival" value="{{ request('rival') }}">

    <!-- Goles mínimos -->
    <input type="number" name="goles_min" class="form-control" 
           placeholder="Mín. goles" min="0" value="{{ request('goles_min') }}">

    <!-- Asistencias mínimas -->
    <input type="number" name="asistencias_min" class="form-control" 
           placeholder="Mín. asistencias" min="0" value="{{ request('asistencias_min') }}">

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('estadistica_partido.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>

 
  {{-- Botón para insertar (solo admin) --}}
@if(Auth::user()->rol === 'admin')
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('estadistica_partido.create') }}" id="insert-btn" class="btn-insertar">
            + Insertar Estadística
        </a>
    </div>

    <x-alert-insert :buttonId="'insert-btn'" />
@endif

<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Partido</th>
            <th>Usuario</th>
            <th>Goles</th>
            <th>Asistencias</th>
            <th>Tarjetas Amarillas</th>
            <th>Tarjetas Rojas</th>

            {{-- Columna Acciones solo para admin o entrenador --}}
            @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                <th>Acciones</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @forelse($estadisticas as $estadistica)
            <tr>
                <td>{{ $estadistica->id_estadistica }}</td>
                <td>{{ $estadistica->partido->rival }}</td>
                <td>{{ $estadistica->usuario->nombre }}</td>
                <td>{{ $estadistica->goles }}</td>
                <td>{{ $estadistica->asistencias }}</td>
                <td>{{ $estadistica->tarjetas_amarillas }}</td>
                <td>{{ $estadistica->tarjetas_rojas }}</td>

                {{-- Acciones según el rol --}}
                @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                    <td>
                        {{-- Editar: admin y entrenador --}}
                        <a href="{{ route('estadistica_partido.edit', $estadistica) }}" 
                           id="edit-btn-{{ $estadistica->id_estadistica }}" 
                           class="btn-editar">
                            Editar
                        </a>
                        <x-alert-edit :buttonId="'edit-btn-'.$estadistica->id_estadistica" />

                        {{-- Eliminar: solo admin --}}
                        @if(Auth::user()->rol === 'admin')
                            <form id="delete-form-{{ $estadistica->id_estadistica }}" 
                                  action="{{ route('estadistica_partido.destroy', $estadistica) }}" 
                                  method="POST" 
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar">Eliminar</button>
                            </form>
                            <x-alert-delete :formId="'delete-form-'.$estadistica->id_estadistica" />
                        @endif

                    </td>
                @endif

            </tr>
        @empty
            <tr>
                @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                    <td colspan="8">No hay estadísticas registradas.</td>
                @else
                    <td colspan="7">No hay estadísticas registradas.</td>
                @endif
            </tr>
        @endforelse
    </tbody>
</table>

</div>

@endsection
