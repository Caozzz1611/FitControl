@extends('layouts.app')

@section('title', 'Listado de Equipos')

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
    <h2>Listado de Equipos</h2>
   <form action="{{ route('equipo.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Nombre del equipo -->
    <input type="text" name="search" class="form-control" 
           placeholder="Nombre del equipo" value="{{ request('search') }}">

    <!-- Ubicación -->
    <input type="text" name="ubicacion" class="form-control" 
           placeholder="Ubicación" value="{{ request('ubicacion') }}">

    <!-- Categoría -->
    <select name="categoria" class="form-select">
        <option value="">Categoría</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria }}" 
                {{ request('categoria') == $categoria ? 'selected' : '' }}>
                {{ $categoria }}
            </option>
        @endforeach
    </select>

    <!-- Botón Buscar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('equipo.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>


    {{-- Botón para insertar (solo ADMIN) --}}
@if(Auth::user()->rol === 'admin')
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('equipo.create') }}" id="insert-btn" class="btn-insertar">
            + Nuevo Equipo
        </a>

        <x-alert-insert :buttonId="'insert-btn'" />
    </div>
@endif
      
<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Logo</th>
            <th>Ubicación</th>
            <th>Contacto</th>
            <th>Categoría</th>
            @if(Auth::user()->rol === 'admin')
                <th>Acciones</th>
            @endif
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

                @if(Auth::user()->rol === 'admin')
                <td>
                    {{-- Botón Editar con alerta (solo ADMIN) --}}
                    <a href="{{ route('equipo.edit', $equipo) }}" 
                       id="edit-btn-{{ $equipo->id_equipo }}" 
                       class="btn-editar">
                        Editar
                    </a>
                    <x-alert-edit :buttonId="'edit-btn-'.$equipo->id_equipo" />

                    {{-- Formulario de eliminar con alerta (solo ADMIN) --}}
                    <form id="delete-form-{{ $equipo->id_equipo }}" 
                          action="{{ route('equipo.destroy', $equipo) }}" 
                          method="POST" 
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">
                            Eliminar
                        </button>
                    </form>
                    <x-alert-delete :formId="'delete-form-'.$equipo->id_equipo" />
                </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ Auth::user()->rol === 'admin' ? 7 : 6 }}">
                    No hay equipos registrados.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</div>
@endsection
