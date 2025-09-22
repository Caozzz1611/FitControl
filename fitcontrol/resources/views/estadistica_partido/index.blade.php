@extends('layouts.app')

@section('title', 'Estadísticas de Partidos')

@section('content')

<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<!-- Incluyendo SweetAlert2 -->
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

    <form action="{{ route('estadistica_partido.index') }}" method="GET" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px;">
    <input type="text" name="usuario" placeholder="Buscar por jugador" value="{{ request('usuario') }}">
    <input type="text" name="rival" placeholder="Buscar por rival" value="{{ request('rival') }}">
    <input type="number" name="goles_min" placeholder="Mín. goles" min="0" value="{{ request('goles_min') }}">
    <input type="number" name="asistencias_min" placeholder="Mín. asistencias" min="0" value="{{ request('asistencias_min') }}">
    
    <button type="submit">Filtrar</button>
    <a href="{{ route('estadistica_partido.index') }}" class="btn-reset" title="Limpiar filtros">
        Limpiar
    </a>
</form>


    {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
       <a href="{{ route('estadistica_partido.create') }}" id="insert-btn" class="btn-insertar">
           + Insertar Estadística
       </a>
    </div>

    <x-alert-insert :buttonId="'insert-btn'" />

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
                <th>Acciones</th>
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
                    <td>
                        <a href="{{ route('estadistica_partido.edit', $estadistica) }}" id="edit-btn-{{ $estadistica->id_estadistica }}" class="btn-editar">Editar</a>

                        <x-alert-edit :buttonId="'edit-btn-'.$estadistica->id_estadistica" />

                        <form id="delete-form-{{ $estadistica->id_estadistica }}" action="{{ route('estadistica_partido.destroy', $estadistica) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>

                        <x-alert-delete :formId="'delete-form-'.$estadistica->id_estadistica" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No hay estadísticas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
