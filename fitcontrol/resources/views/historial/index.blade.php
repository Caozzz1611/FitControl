@extends('layouts.app')

@section('title', 'Historial Médico')

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
    <h2 class="h2L">Historial Médico</h2>
    <form action="{{ route('historial.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Buscar observaciones -->
    <input type="text" name="search" class="form-control" 
           placeholder="Buscar observaciones" value="{{ request('search') }}">

    <!-- Usuario -->
    <select name="usuario" class="form-select">
        <option value="">Todos los usuarios</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}" {{ request('usuario') == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>

    <!-- Fecha mínima -->
    <input type="date" name="fecha_min" class="form-control" 
           value="{{ request('fecha_min') }}">

    <!-- Fecha máxima -->
    <input type="date" name="fecha_max" class="form-control" 
           value="{{ request('fecha_max') }}">

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('historial.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>
{{-- Botón para insertar (solo admin) --}}
@if(Auth::user()->rol === 'admin')
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('historial.create') }}" id="insert-btn" class="btn-insertar">
            + Nuevo Historial
        </a>

        <x-alert-insert :buttonId="'insert-btn'" />
    </div>
@endif

<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Observaciones</th>
            <th>Fecha</th>
            <th>Usuario</th>

            {{-- Acciones solo para admin y entrenador --}}
            @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                <th>Acciones</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @foreach($historiales as $historial)
            <tr>
                <td>{{ $historial->id_historial }}</td>
                <td>{{ $historial->observaciones }}</td>
                <td>{{ $historial->fecha }}</td>
                <td>
                    {{ $historial->usuario ? $historial->usuario->nombre . ' ' . $historial->usuario->apellido : '-' }}
                </td>

                {{-- Acciones --}}
                @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                    <td>

                        {{-- Editar (admin y entrenador) --}}
                        <a href="{{ route('historial.edit', $historial) }}"
                           id="edit-btn-{{ $historial->id_historial }}"
                           class="btn-editar">
                            Editar
                        </a>

                        <x-alert-edit :buttonId="'edit-btn-'.$historial->id_historial" />

                        {{-- Eliminar (solo admin) --}}
                        @if(Auth::user()->rol === 'admin')
                            <form id="delete-form-{{ $historial->id_historial }}"
                                  action="{{ route('historial.destroy', $historial) }}"
                                  method="POST"
                                  style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar">
                                    Eliminar
                                </button>
                            </form>

                            <x-alert-delete :formId="'delete-form-'.$historial->id_historial" />
                        @endif

                    </td>
                @endif

            </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection
