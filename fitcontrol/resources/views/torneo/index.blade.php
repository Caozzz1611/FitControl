@extends('layouts.app')

@section('title', 'Torneos')

@section('content')
<!-- Incluyendo Notyf -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

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
    <h2 class="h2L">Listado de Torneos</h2>

 {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
       <a href="{{ route('torneo.create') }}" id="insert-btn" class="btn-insertar">
    + Insertar Torneo
</a>
<x-alert-insert :buttonId="'insert-btn'" />
<br>

    </div>

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Premio</th>
                <th>Descripción</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Organizador Asociado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($torneos as $torneo)
                <tr>
                    <td>{{ $torneo->id_torneo }}</td>
                    <td>{{ $torneo->nombre }}</td>
                    <td>{{ $torneo->premio }}</td>
                    <td>{{ $torneo->descripcion }}</td>
                    <td>{{ $torneo->fecha_inicio }}</td>
                    <td>{{ $torneo->fecha_fin }}</td>
                    <td>{{ $torneo->equipo ? $torneo->equipo->nombre_equipo : '-' }}</td>
                    <td>
                        <a href="{{ route('torneo.edit', $torneo) }}" id="edit-btn-{{ $torneo->id_torneo }}" class="btn-editar">
                            Editar
                        </a>
                        <x-alert-edit :buttonId="'edit-btn-'.$torneo->id_torneo" />

                        <form id="delete-form-{{ $torneo->id_torneo }}" 
                              action="{{ route('torneo.destroy', $torneo) }}" 
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>
                        <x-alert-delete :formId="'delete-form-'.$torneo->id_torneo" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No hay torneos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection
