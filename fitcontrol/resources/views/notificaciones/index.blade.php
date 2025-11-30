@extends('layouts.app')

@section('title', 'Notificaciones')

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
    <h2 class="h2L">Listado de Notificaciones</h2>

    <!-- Formulario de filtros -->
   <form action="{{ route('notificaciones.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Buscar título o mensaje -->
    <input type="text" name="search" class="form-control" 
           placeholder="Buscar título o mensaje" value="{{ request('search') }}">

    <!-- Usuario -->
    <select name="usuario" class="form-select">
        <option value="">Todos los usuarios</option>
        @foreach($usuarios as $user)
            <option value="{{ $user->id_usu }}" {{ request('usuario') == $user->id_usu ? 'selected' : '' }}>
                {{ $user->nombre }} {{ $user->apellido }}
            </option>
        @endforeach
    </select>

    <!-- Fecha mínima -->
    <input type="date" name="fecha_min" class="form-control" 
           value="{{ request('fecha_min') }}" placeholder="Desde">

    <!-- Fecha máxima -->
    <input type="date" name="fecha_max" class="form-control" 
           value="{{ request('fecha_max') }}" placeholder="Hasta">

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('notificaciones.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>

   {{-- Botón para insertar (solo admin) --}}
@if(Auth::user()->rol === 'admin')
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('notificaciones.create') }}" id="insert-btn" class="btn-insertar">
            + Crear Notificación
        </a>

        <x-alert-insert :buttonId="'insert-btn'" />
    </div>
@endif

<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Mensaje</th>
            <th>Fecha</th>
            <th>Usuario Destinatario</th>

            {{-- Acciones solo para admin --}}
            @if(Auth::user()->rol === 'admin')
                <th>Acciones</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @foreach($notificaciones as $notificacion)
        <tr>
            <td>{{ $notificacion->id_notificacion }}</td>
            <td>{{ $notificacion->titulo }}</td>
            <td>{{ $notificacion->mensaje }}</td>
            <td>{{ $notificacion->fecha }}</td>
            <td>{{ $notificacion->usuarioDestinatario->nombre ?? '-' }}</td>

            {{-- Acciones solo admin --}}
            @if(Auth::user()->rol === 'admin')
                <td>
                    {{-- Editar --}}
                    <a href="{{ route('notificaciones.edit', ['notificacion' => $notificacion->id_notificacion]) }}"
                        id="edit-btn-{{ $notificacion->id_notificacion }}" 
                        class="btn-editar">
                        Editar
                    </a>

                    <x-alert-edit :buttonId="'edit-btn-'.$notificacion->id_notificacion" />

                    {{-- Eliminar --}}
                    <form id="delete-form-{{ $notificacion->id_notificacion }}" 
                          action="{{ route('notificaciones.destroy', $notificacion) }}" 
                          method="POST" 
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>

                    <x-alert-delete :formId="'delete-form-'.$notificacion->id_notificacion" />
                </td>
            @endif

        </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection
