@extends('layouts.app')

@section('title', 'Entrenamientos')

@section('content')

<!-- Notyf y SweetAlert (igual que los ejemplos anteriores) -->
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
    <h2 class="h2L">Listado de Entrenamientos</h2>

   <form method="GET" 
      action="{{ route('entrenamiento.index') }}"
      class="d-flex flex-wrap gap-2 mb-3"
      autocomplete="off">

    <!-- Fecha -->
    <input type="date" 
           name="fecha" 
           value="{{ request('fecha') }}"
           class="form-control form-control-sm"
           style="width: 150px">

    <!-- Hora -->
    <input type="time" 
           name="hora" 
           value="{{ request('hora') }}"
           class="form-control form-control-sm"
           style="width: 130px">

    <!-- Ubicación -->
    <input type="text" 
           name="ubicacion" 
           value="{{ request('ubicacion') }}"
           placeholder="Ubicación"
           class="form-control form-control-sm"
           style="width: 180px">

    <!-- Equipo -->
    <input type="text" 
           name="equipo" 
           value="{{ request('equipo') }}"
           placeholder="Equipo"
           class="form-control form-control-sm"
           style="width: 160px ">

    <!-- Botón Filtrar -->
    <button type="submit" 
            class="btn btn-primary btn-sm">
        Filtrar
    </button>

    <!-- Botón Limpiar -->
    <a href="{{ route('entrenamiento.index') }}" 
       class="btn btn-secondary btn-sm">
        Limpiar
    </a>
</form>


    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('entrenamiento.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Entrenamiento</a>
    </div>

    <x-alert-insert :buttonId="'insert-btn'" />

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Ubicación</th>
                <th>Equipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($entrenamientos as $entrenamiento)
                <tr>
                    <td>{{ $entrenamiento->id_entrenamiento }}</td>
                    <td>{{ $entrenamiento->fecha }}</td>
                    <td>{{ $entrenamiento->hora }}</td>
                    <td>{{ $entrenamiento->ubicacion }}</td>
                    <td>{{ $entrenamiento->equipo?->nombre_equipo ?? '-' }}</td>
                    <td>
                        <a href="{{ route('entrenamiento.edit', $entrenamiento) }}" id="edit-btn-{{ $entrenamiento->id_entrenamiento }}" class="btn-editar">Editar</a>

                        <x-alert-edit :buttonId="'edit-btn-'.$entrenamiento->id_entrenamiento" />

                        <form id="delete-form-{{ $entrenamiento->id_entrenamiento }}" action="{{ route('entrenamiento.destroy', $entrenamiento) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar" onclick="confirmDelete({{ $entrenamiento->id_entrenamiento }})">Eliminar</button>
                        </form>

                        <x-alert-delete :formId="'delete-form-'.$entrenamiento->id_entrenamiento" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay entrenamientos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
