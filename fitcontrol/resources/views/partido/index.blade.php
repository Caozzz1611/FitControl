@extends('layouts.app')

@section('title', 'Partidos')

@section('content')
<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


<!-- Script para mostrar alertas -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notyf = new Notyf();

        @if(session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            notyf.error("{{ session('error') }}");
        @endif
    });
</script>

<div class="card">
    <h2 class="h2L">Listado de Partidos</h2>

   <form action="{{ route('partido.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Rival -->
    <input type="text" name="rival" class="form-control" 
           placeholder="Buscar por rival" value="{{ request('rival') }}">

    <!-- Fecha inicio -->
    <input type="date" name="fecha_inicio" class="form-control" 
           value="{{ request('fecha_inicio') }}">

    <!-- Fecha fin -->
    <input type="date" name="fecha_fin" class="form-control" 
           value="{{ request('fecha_fin') }}">

    <!-- Torneo -->
    <select name="torneo" class="form-select">
        <option value="">Todos los torneos</option>
        @foreach($torneos as $torneo)
            <option value="{{ $torneo->id_torneo }}" {{ request('torneo') == $torneo->id_torneo ? 'selected' : '' }}>
                {{ $torneo->nombre }}
            </option>
        @endforeach
    </select>

    <!-- Equipo -->
    <select name="equipo" class="form-select">
        <option value="">Todos los equipos</option>
        @foreach($equipos as $equipo)
            <option value="{{ $equipo->id_equipo }}" {{ request('equipo') == $equipo->id_equipo ? 'selected' : '' }}>
                {{ $equipo->nombre_equipo }}
            </option>
        @endforeach
    </select>

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('partido.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>

{{-- Botón para insertar (solo admin) --}}
@if(Auth::user()->rol === 'admin')
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('partido.create') }}" id="insert-btn" class="btn-insertar">
            + Insertar Partido
        </a>

        <x-alert-insert :buttonId="'insert-btn'" />
    </div>
@endif

<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Rival</th>
            <th>Resultado</th>
            <th>Torneo</th>
            <th>Equipo</th>

            @if(Auth::user()->rol === 'admin')
                <th>Acciones</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @forelse($partidos as $partido)
            <tr>
                <td>{{ $partido->id_partido }}</td>
                <td>{{ $partido->fecha }}</td>
                <td>{{ $partido->hora }}</td>
                <td>{{ $partido->rival }}</td>
                <td>{{ $partido->resultado }}</td>
                <td>{{ $partido->torneo->nombre ?? '' }}</td>
                <td>{{ $partido->equipo->nombre_equipo ?? '' }}</td>

                {{-- Acciones solo para ADMIN --}}
                @if(Auth::user()->rol === 'admin')
                    <td>
                        <a href="{{ route('partido.edit', $partido) }}" 
                           id="edit-btn-{{ $partido->id_partido }}" 
                           class="btn-editar">
                            Editar
                        </a>
                        <x-alert-edit :buttonId="'edit-btn-'.$partido->id_partido" />

                        <form id="delete-form-{{ $partido->id_partido }}" 
                              action="{{ route('partido.destroy', $partido) }}" 
                              method="POST" 
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>
                        <x-alert-delete :formId="'delete-form-'.$partido->id_partido" />
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                @if(Auth::user()->rol === 'admin')
                    <td colspan="8">No hay partidos registrados.</td>
                @else
                    <td colspan="7">No hay partidos registrados.</td>
                @endif
            </tr>
        @endforelse
    </tbody>
</table>

</div>
@endsection
