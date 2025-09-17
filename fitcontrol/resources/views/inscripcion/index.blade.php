@extends('layouts.app')

@section('title', 'Inscripciones')

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
    });

    function confirmDelete(id) {
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
    }
</script>

<div class="card">
    <h2 class="h2L">Listado de Inscripciones</h2>

    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('inscripcion.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Inscripción</a>
    </div>

    <x-alert-insert :buttonId="'insert-btn'" />

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Torneo</th>
                <th>Fecha de Inscripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->id_inscripcion }}</td>
                    <td>{{ $inscripcion->usuario?->nombre ?? '-' }} {{ $inscripcion->usuario?->apellido ?? '' }}</td>
                    <td>{{ $inscripcion->torneo?->nombre ?? '-' }}</td>
                    <td>{{ $inscripcion->fecha_inscripcion }}</td>
                    <td>{{ $inscripcion->estado }}</td>
                    <td>
                        <a href="{{ route('inscripcion.edit', $inscripcion) }}" id="edit-btn-{{ $inscripcion->id_inscripcion }}" class="btn-editar">Editar</a>

<x-alert-edit :buttonId="'edit-btn-'.$inscripcion->id_inscripcion" />


                        <form id="delete-form-{{ $inscripcion->id_inscripcion }}" action="{{ route('inscripcion.destroy', $inscripcion) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar" onclick="confirmDelete({{ $inscripcion->id_inscripcion }})">Eliminar</button>
                        </form>

                        <x-alert-delete :formId="'delete-form-'.$inscripcion->id_inscripcion" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay inscripciones registradas.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
