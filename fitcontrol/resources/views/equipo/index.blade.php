@extends('layouts.app')

@section('title', 'Listado de Equipos')

@section('content')
<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>


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
    <h2>Listado de Equipos</h2>
    <form action="{{ route('equipo.index') }}" method="GET" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px;">
    <input type="text" name="search" placeholder="Buscar nombre de equipo" value="{{ request('search') }}">

    <input type="text" name="ubicacion" placeholder="Ubicación" value="{{ request('ubicacion') }}">

    <select name="categoria">
        <option value="">Todas las categorías</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
                {{ $categoria }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filtrar</button>
    <a href="{{ route('equipo.index') }}" class="btn-reset" title="Limpiar filtros">
        <i class="fas fa-sync-alt"></i>
    </a>
</form>

    {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('equipo.create') }}" id="insert-btn" class="btn-insertar">
            + Nuevo Equipo
        </a>

        <x-alert-insert :buttonId="'insert-btn'" />
    </div>
      
    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Logo</th>
                <th>Ubicación</th>
                <th>Contacto</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipos as $equipo)
                <tr>
                    <td>{{ $equipo->id_equipo }}</td>
                    <td>{{ $equipo->nombre_equipo }}</td>
                    <td>{{ $equipo->logo_equipo }}</td>
                    <td>{{ $equipo->ubi_equipo }}</td>
                    <td>{{ $equipo->contacto_equipo }}</td>
                    <td>{{ $equipo->categoria_equipo }}</td>
                   <td>
    {{-- Botón Editar con alerta --}}
    <a href="{{ route('equipo.edit', $equipo) }}" id="edit-btn-{{ $equipo->id_equipo }}" class="btn-editar">
        Editar
    </a>
    <x-alert-edit :buttonId="'edit-btn-'.$equipo->id_equipo" />

    {{-- Formulario de eliminar con alerta --}}
    <form id="delete-form-{{ $equipo->id_equipo }}" action="{{ route('equipo.destroy', $equipo) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-eliminar">
            Eliminar
        </button>
    </form>
    <x-alert-delete :formId="'delete-form-'.$equipo->id_equipo" />
</td>

                </tr>
            @empty
                <tr><td colspan="7">No hay equipos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection
