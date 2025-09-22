@extends('layouts.app')

@section('title', 'Listado de Rendimientos')

@section('content')

<div class="card">
    <h2 class="h2L">Listado de Rendimientos</h2>

    <div style="height: 50px; margin-bottom: 15px;">
        <a href="{{ route('rendimiento.create') }}" id="insert-btn" class="btn-insertar">+ Insertar Rendimiento</a>
        <x-alert-insert :buttonId="'insert-btn'" />
        <br>
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
                        <a href="{{ route('rendimiento.edit', $rendimiento) }}" id="edit-btn-{{ $rendimiento->id_rendimiento }}" class="btn-editar">Editar</a>
                        <x-alert-edit :buttonId="'edit-btn-'.$rendimiento->id_rendimiento" />

                        <form id="delete-form-{{ $rendimiento->id_rendimiento }}" 
                              action="{{ route('rendimiento.destroy', $rendimiento) }}" 
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>
                        <x-alert-delete :formId="'delete-form-'.$rendimiento->id_rendimiento" />
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay rendimientos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
