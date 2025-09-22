@extends('layouts.app')

@section('title', 'Notificaciones')

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
    <h2 class="h2L">Listado de Notificaciones</h2>

    {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('notificaciones.create') }}" id="insert-btn" class="btn-insertar">
            + Crear Notificación
        </a>

        <x-alert-insert :buttonId="'insert-btn'" />
    </div>

    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Mensaje</th>
                <th>Fecha</th>
                <th>Usuario Destinatario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notificaciones as $notificacion)
            <tr>
                <td>{{ $notificacion->id_notificacion }}</td>
                <td>{{ $notificacion->titulo }}</td>
                <td>{{ $notificacion->mensaje }}</td>
                <td>{{ $notificacion->fecha }}</td>
                <td>{{ $notificacion->usuarioDestinatario->nombre ?? '-' }}</td>
                <td>
                    {{-- Botón Editar --}}
                    <a href="{{ route('notificaciones.edit', ['notificacion' => $notificacion->id_notificacion]) }}" 
   id="edit-btn-{{ $notificacion->id_notificacion }}" class="btn-editar">
    Editar
</a>
                    <x-alert-edit :buttonId="'edit-btn-'.$notificacion->id_notificacion" />

                    {{-- Formulario Eliminar --}}
                    <form id="delete-form-{{ $notificacion->id_notificacion }}" action="{{ route('notificaciones.destroy', $notificacion) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                    <x-alert-delete :formId="'delete-form-'.$notificacion->id_notificacion" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

@endsection
