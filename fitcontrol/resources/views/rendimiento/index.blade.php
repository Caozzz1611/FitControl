@extends('layouts.app')

@section('title', 'Listado de Rendimientos')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


<div class="card">
    <h2 class="h2L">Listado de Rendimientos</h2>
  <form method="GET" action="{{ route('rendimiento.index') }}" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Usuario -->
    <input type="text" name="usuario" class="form-control" 
           value="{{ request('usuario') }}" placeholder="Nombre de Usuario">

    <!-- Entrenamiento -->
    <input type="text" name="entrenamiento" class="form-control" 
           value="{{ request('entrenamiento') }}" placeholder="Entrenamiento">

    <!-- Fecha Inicio -->
    <input type="date" name="fecha_inicio" class="form-control" 
           value="{{ request('fecha_inicio') }}" placeholder="Fecha Inicio">

    <!-- Fecha Fin -->
    <input type="date" name="fecha_fin" class="form-control" 
           value="{{ request('fecha_fin') }}" placeholder="Fecha Fin">

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
    <button>
        <a href="{{ route('rendimiento.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise"></i>
        </a>
    </button>

</form>

{{-- Botón para insertar (ADMIN y ENTRENADOR) --}}
@if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
<div style="height: 50px; margin-bottom: 15px;">
    <a href="{{ route('rendimiento.create') }}" id="insert-btn" class="btn-insertar">
        + Insertar Rendimiento
    </a>

    <x-alert-insert :buttonId="'insert-btn'" />
    <br>
</div>
@endif


<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Evaluación</th>
            <th>Comentarios</th>
            <th>Usuario</th>
            <th>Entrenamiento</th>

            {{-- Acciones solo admin o entrenador --}}
            @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                <th>Acciones</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse($rendimientos as $rendimiento)
            <tr>
                <td>{{ $rendimiento->id_rendimiento }}</td>
                <td>{{ $rendimiento->evaluacion }}</td>
                <td>{{ $rendimiento->comentarios }}</td>
                <td>{{ $rendimiento->usuario->nombre ?? 'N/A' }}</td>
                <td>{{ $rendimiento->entrenamiento->fecha ?? 'N/A' }}</td>

                {{-- Acciones ADMIN y ENTRENADOR --}}
                @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                <td>
                    {{-- Botón Editar --}}
                    <a href="{{ route('rendimiento.edit', $rendimiento) }}"
                       id="edit-btn-{{ $rendimiento->id_rendimiento }}"
                       class="btn-editar">
                        Editar
                    </a>
                    <x-alert-edit :buttonId="'edit-btn-'.$rendimiento->id_rendimiento" />

                    {{-- Eliminar SOLO admin --}}
                    @if(Auth::user()->rol === 'admin')
                    <form id="delete-form-{{ $rendimiento->id_rendimiento }}"
                          action="{{ route('rendimiento.destroy', $rendimiento) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-eliminar">
                            Eliminar
                        </button>
                    </form>

                    <x-alert-delete :formId="'delete-form-'.$rendimiento->id_rendimiento" />
                    @endif

                </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ (Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador') ? 6 : 5 }}">
                    No hay rendimientos registrados.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</div>

@endsection

