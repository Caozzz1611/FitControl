@extends('layouts.app')

@section('title', 'Listado de Rendimientos')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
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
    <h2 class="h2L">Listado de Rendimientos</h2>

    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('rendimiento.create') }}" class="btn-insertar">+ Insertar Rendimiento</a>
    </div>

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Evaluación</th>
                <th>Comentarios</th>
                <th>Usuario</th>
                <th>Entrenamiento</th>
                <th>Acciones</th>
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
                    <td>
                        <a href="{{ route('rendimiento.edit', $rendimiento) }}" class="btn-editar">Editar</a>

                        <form id="delete-form-{{ $rendimiento->id_rendimiento }}" action="{{ route('rendimiento.destroy', $rendimiento) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar" onclick="confirmDelete({{ $rendimiento->id_rendimiento }})">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay rendimientos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $rendimientos->links() }}
</div>

@endsection
