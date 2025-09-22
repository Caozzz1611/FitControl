@extends('layouts.app')

@section('title', 'Inscripciones a Equipos')

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

        // Confirmación de eliminar
        document.querySelectorAll('.btn-eliminar').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
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
    });
</script>

<div class="card">
    <h2 class="h2L">Listado de Inscripciones a Equipos</h2>

    <!-- Filtros -->
    <form method="GET" action="{{ route('inscripcion_equipo.index') }}" style="margin-bottom: 20px; display: flex; gap: 10px;">
        <!-- Filtro por usuario -->
        <input type="text" name="usuario" value="{{ request('usuario') }}" placeholder="Buscar Usuario" class="form-control">

        <!-- Filtro por equipo -->
        <input type="text" name="equipo" value="{{ request('equipo') }}" placeholder="Buscar Equipo" class="form-control">

        <!-- Filtro por estado -->
        <select name="estado" class="form-control">
            <option value="">Selecciona Estado</option>
            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completado" {{ request('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
        </select>

        <!-- Filtro por fecha -->
        <input type="date" name="fecha_inscripcion" value="{{ request('fecha_inscripcion') }}" class="form-control">

        <!-- Botón Filtrar -->
        <button type="submit" class="btn btn-primary">Filtrar</button>

        <!-- Botón Limpiar Filtros -->
        <a href="{{ route('inscripcion_equipo.index') }}" class="btn btn-secondary">Limpiar</a>
    </form>

    <!-- Insertar Nueva Inscripción -->
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('inscripcion_equipo.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Inscripción</a>
    </div>

    <x-alert-insert :buttonId="'insert-btn'" />

    <!-- Tabla de Inscripciones -->
    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Equipo</th>
                <th>Usuario</th>
                <th>Fecha Inscripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->id_inscripcion }}</td>
                    <td>{{ $inscripcion->equipo?->nombre_equipo ?? '-' }}</td>
                    <td>{{ $inscripcion->usuario?->nombre ?? '-' }}</td>
                    <td>{{ $inscripcion->fecha_inscripcion }}</td>
                    <td>{{ ucfirst($inscripcion->estado) }}</td>
                    <td>
                        <a href="{{ route('inscripcion_equipo.edit', $inscripcion) }}" id="edit-btn-{{ $inscripcion->id_inscripcion }}" class="btn-editar">Editar</a>
                        <x-alert-edit :buttonId="'edit-btn-'.$inscripcion->id_inscripcion" />

                        <form id="delete-form-{{ $inscripcion->id_inscripcion }}" action="{{ route('inscripcion_equipo.destroy', $inscripcion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar" data-id="{{ $inscripcion->id_inscripcion }}">Eliminar</button>
                        </form>

                        <x-alert-delete :formId="'delete-form-'.$inscripcion->id_inscripcion" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay inscripciones registradas.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="pagination">
        {{ $inscripciones->links() }}
    </div>
</div>

@endsection
