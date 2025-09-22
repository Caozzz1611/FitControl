@extends('layouts.app')

@section('title', 'Historial Médico')

@section('content')

<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

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
    <form action="{{ route('historial.index') }}" method="GET" style="margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px;">
    <input type="text" name="search" placeholder="Buscar observaciones" value="{{ request('search') }}">

    <select name="usuario">
        <option value="">Todos los usuarios</option>
        @foreach($usuarios as $usuario)
            <option value="{{ $usuario->id_usu }}" {{ request('usuario') == $usuario->id_usu ? 'selected' : '' }}>
                {{ $usuario->nombre }} {{ $usuario->apellido }}
            </option>
        @endforeach
    </select>

    <input type="date" name="fecha_min" value="{{ request('fecha_min') }}">
    <input type="date" name="fecha_max" value="{{ request('fecha_max') }}">

    <button type="submit">Filtrar</button>
    <a href="{{ route('historial.index') }}" class="btn-reset" title="Limpiar filtros">
        <i class="fas fa-sync-alt"></i>
    </a>
</form>


    {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('historial.create') }}" id="insert-btn" class="btn-insertar">
            + Nuevo Historial
        </a>

        <x-alert-insert :buttonId="'insert-btn'" />
    </div>

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Observaciones</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Acciones</th>
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
                <td>
                    <a href="{{ route('historial.edit', $historial) }}" id="edit-btn-{{ $historial->id_historial }}" class="btn-editar">
                        Editar
                    </a>
                    <x-alert-edit :buttonId="'edit-btn-'.$historial->id_historial" />

                    {{-- Formulario de eliminar --}}
                    <form id="delete-form-{{ $historial->id_historial }}" action="{{ route('historial.destroy', $historial) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">
                            Eliminar
                        </button>
                    </form>

                    <x-alert-delete :formId="'delete-form-'.$historial->id_historial" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
