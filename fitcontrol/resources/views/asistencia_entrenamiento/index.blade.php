@extends('layouts.app')

@section('title', 'Asistencias Entrenamiento')

@section('content')

<!-- Notyf y SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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

        // Confirmación para eliminar
        document.querySelectorAll('.btn-eliminar').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // prevenir submit automático
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡Esta acción no se puede deshacer!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });

        // Confirmación para editar
        document.querySelectorAll('.btn-editar').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                Swal.fire({
                    title: '¿Quieres editar este registro?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, editar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    });
</script>

<div class="card">
    <h2 class="h2L">Listado de Asistencias a Entrenamientos</h2>
<form action="{{ route('asistencia_entrenamiento.index') }}" method="GET" class="input-group mb-3 shadow-sm" autocomplete="off">

    <!-- Fecha -->
    <input type="date" name="fecha_entrenamiento" class="form-control" 
           value="{{ request('fecha_entrenamiento') }}" 
           placeholder="Fecha">

    <!-- Jugador -->
    <input type="text" name="jugador" class="form-control" 
           value="{{ request('jugador') }}" 
           placeholder="Jugador">

    <!-- Asistencia -->
    <select name="asistio" class="form-select">
        <option value="">Asistió</option>
        <option value="1" {{ request('asistio') == '1' ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ request('asistio') == '0' ? 'selected' : '' }}>No</option>
    </select>

    <!-- Botón Filtrar -->
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-search"></i>
    </button>

    <!-- Botón Limpiar -->
   <button><a href="{{ route('asistencia_entrenamiento.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-clockwise"></i>
    </a></button> 

</form>


   {{-- Botón para insertar (admin y entrenador) --}}
@if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('asistencia_entrenamiento.create') }}" id="insert-btn" class="btn-insertar">
            + Insertar Asistencia
        </a>
    </div>

    <x-alert-insert :buttonId="'insert-btn'" />
@endif


<table class="tabla-usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Entrenamiento</th>
            <th>Jugador</th>
            <th>Asistió</th>

            {{-- Acciones visibles solo para admin y entrenador --}}
            @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                <th>Acciones</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @forelse($asistencias as $asistencia)
            <tr>
                <td>{{ $asistencia->id_asistencia }}</td>
                <td>{{ $asistencia->entrenamiento?->fecha ?? '-' }} - {{ $asistencia->entrenamiento?->hora ?? '-' }}</td>
                <td>{{ $asistencia->jugador?->nombre ?? '-' }}</td>
                <td>{{ $asistencia->asistio ? 'Sí' : 'No' }}</td>

                {{-- Acciones: admin y entrenador --}}
                @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                    <td>
                        {{-- Editar --}}
                        <a href="{{ route('asistencia_entrenamiento.edit', $asistencia) }}"
                           id="edit-btn-{{ $asistencia->id_asistencia }}"
                           class="btn-editar">
                            Editar
                        </a>

                        {{-- Alerta de editar --}}
                        <x-alert-edit :buttonId="'edit-btn-'.$asistencia->id_asistencia" />

                        {{-- Eliminar --}}
                        <form id="delete-form-{{ $asistencia->id_asistencia }}"
                              action="{{ route('asistencia_entrenamiento.destroy', $asistencia) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>

                        {{-- Alerta eliminar --}}
                        <x-alert-delete :formId="'delete-form-'.$asistencia->id_asistencia" />
                    </td>
                @endif

            </tr>
        @empty
            <tr>
                @if(Auth::user()->rol === 'admin' || Auth::user()->rol === 'entrenador')
                    <td colspan="5">No hay asistencias registradas.</td>
                @else
                    <td colspan="4">No hay asistencias registradas.</td>
                @endif
            </tr>
        @endforelse
    </tbody>
</table>

</div>

@endsection
