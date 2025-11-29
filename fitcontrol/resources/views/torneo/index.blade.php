@extends('layouts.app')

@section('title', 'Torneos')

@section('content')
<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


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
    <h2 class="h2L">Listado de Torneos</h2>

   <form action="{{ route('torneo.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Buscar por nombre -->
    <input type="text" name="search" class="form-control" 
           placeholder="Buscar por nombre" value="{{ request('search') }}">

    <!-- Fecha inicio -->
    <input type="date" name="fecha_inicio" class="form-control" 
           value="{{ request('fecha_inicio') }}">

    <!-- Fecha fin -->
    <input type="date" name="fecha_fin" class="form-control" 
           value="{{ request('fecha_fin') }}">

    {{-- Filtro por equipo solo para admin --}}
    @if(Auth::user()->rol == 'admin')
        <select name="equipo" class="form-select">
            <option value="">Todos los organizadores</option>
            @foreach($equipos as $equipo)
                <option value="{{ $equipo->id_equipo }}" {{ request('equipo') == $equipo->id_equipo ? 'selected' : '' }}>
                    {{ $equipo->nombre_equipo }}
                </option>
            @endforeach
        </select>
    @endif

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('torneo.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>


    {{-- Botón para insertar solo para admin --}}
    @if(Auth::user()->rol == 'admin')
        <div style="height: 50px; margin-bottom: 15px;">
            <a href="{{ route('torneo.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Torneo</a>
            <x-alert-insert :buttonId="'insert-btn'" />
            <br>
        </div>
    @endif

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Premio</th>
                <th>Descripción</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Organizador Asociado</th>

                {{-- Columna acciones solo para admin --}}
                @if(Auth::user()->rol == 'admin')
                    <th>Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($torneos as $torneo)
                <tr>
                    <td>{{ $torneo->id_torneo }}</td>
                    <td>{{ $torneo->nombre }}</td>
                    <td>{{ $torneo->premio }}</td>
                    <td>{{ $torneo->descripcion }}</td>
                    <td>{{ $torneo->fecha_inicio }}</td>
                    <td>{{ $torneo->fecha_fin }}</td>
                    <td>{{ $torneo->equipo ? $torneo->equipo->nombre_equipo : '-' }}</td>

                    {{-- Acciones solo para admin --}}
                    @if(Auth::user()->rol == 'admin')
                        <td>
                            <a href="{{ route('torneo.edit', $torneo) }}" id="edit-btn-{{ $torneo->id_torneo }}" class="btn-editar">Editar</a>
                            <x-alert-edit :buttonId="'edit-btn-'.$torneo->id_torneo" />

                            <form id="delete-form-{{ $torneo->id_torneo }}" 
                                  action="{{ route('torneo.destroy', $torneo) }}" 
                                  method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar">Eliminar</button>
                            </form>
                            <x-alert-delete :formId="'delete-form-'.$torneo->id_torneo" />
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Auth::user()->rol == 'admin' ? 8 : 7 }}" class="text-center">No hay torneos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
