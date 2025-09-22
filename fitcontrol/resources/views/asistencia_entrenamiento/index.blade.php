@extends('layouts.app')

@section('title', 'Asistencias Entrenamiento')

@section('content')

<!-- Notyf y SweetAlert -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
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
    <form method="GET" action="{{ route('asistencia_entrenamiento.index') }}" style="margin-bottom: 20px; display: flex; gap: 10px;">
    <!-- Filtro por fecha de entrenamiento -->
    <input type="date" name="fecha_entrenamiento" value="{{ request('fecha_entrenamiento') }}" placeholder="Fecha Entrenamiento">

    <!-- Filtro por nombre de jugador -->
    <input type="text" name="jugador" value="{{ request('jugador') }}" placeholder="Jugador">

    <!-- Filtro por asistencia -->
    <select name="asistio">
        <option value="">Asistió</option>
        <option value="1" {{ request('asistio') == '1' ? 'selected' : '' }}>Sí</option>
        <option value="0" {{ request('asistio') == '0' ? 'selected' : '' }}>No</option>
    </select>

    <!-- Botón Filtrar -->
    <button type="submit">Filtrar</button>

    <!-- Botón Limpiar Filtros -->
    <a href="{{ route('asistencia_entrenamiento.index') }}" class="btn-reset">Limpiar</a>
</form>


    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('asistencia_entrenamiento.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Asistencia</a>
    </div>

    <x-alert-insert :buttonId="'insert-btn'" />

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Entrenamiento</th>
                <th>Jugador</th>
                <th>Asistió</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->id_asistencia }}</td>
                    <td>{{ $asistencia->entrenamiento?->fecha ?? '-' }} - {{ $asistencia->entrenamiento?->hora ?? '-' }}</td>
                    <td>{{ $asistencia->jugador?->nombre ?? '-' }}</td>
                    <td>{{ $asistencia->asistio ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('asistencia_entrenamiento.edit', $asistencia) }}" id="edit-btn-{{ $asistencia->id_asistencia_entrenamiento }}" class="btn-editar">Editar</a>

                        <form id="delete-form-{{ $asistencia->id_asistencia_entrenamiento }}" action="{{ route('asistencia_entrenamiento.destroy', $asistencia) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar" data-id="{{ $asistencia->id_asistencia_entrenamiento }}">Eliminar</button>
                        </form>

                        <x-alert-delete :formId="'delete-form-'.$asistencia->id_asistencia_entrenamiento" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No hay asistencias registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
