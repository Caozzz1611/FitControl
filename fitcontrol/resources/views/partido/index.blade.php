@extends('layouts.app')

@section('title', 'Partidos')

@section('content')
<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

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

    <form action="{{ route('partido.index') }}" method="GET" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px;">
    <input type="text" name="rival" placeholder="Buscar por rival" value="{{ request('rival') }}">
    
    <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
    <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}">

    <select name="torneo">
        <option value="">Todos los torneos</option>
        @foreach($torneos as $torneo)
            <option value="{{ $torneo->id_torneo }}" {{ request('torneo') == $torneo->id_torneo ? 'selected' : '' }}>
                {{ $torneo->nombre }}
            </option>
        @endforeach
    </select>

    <select name="equipo">
        <option value="">Todos los equipos</option>
        @foreach($equipos as $equipo)
            <option value="{{ $equipo->id_equipo }}" {{ request('equipo') == $equipo->id_equipo ? 'selected' : '' }}>
                {{ $equipo->nombre_equipo }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filtrar</button>
    <a href="{{ route('partido.index') }}" class="btn-reset" title="Limpiar filtros">
        <i class="fas fa-sync-alt"></i>
    </a>
</form>


    {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
       <a href="{{ route('partido.create') }}" id="insert-btn" class="btn-insertar">
           + Insertar Partido
       </a>

       <x-alert-insert :buttonId="'insert-btn'" />
    </div>

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
                <th>Acciones</th>
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
                    <td>
                        <a href="{{ route('partido.edit', $partido) }}" id="edit-btn-{{ $partido->id_partido }}" class="btn-editar">
                            Editar
                        </a>
                        <x-alert-edit :buttonId="'edit-btn-'.$partido->id_partido" />

                        <form id="delete-form-{{ $partido->id_partido }}" action="{{ route('partido.destroy', $partido) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>
                        <x-alert-delete :formId="'delete-form-'.$partido->id_partido" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No hay partidos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
