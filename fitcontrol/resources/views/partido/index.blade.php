@extends('layouts.app')

@section('title', 'Partidos')

@section('content')
<div class="card">
    <h2>Listado de Partidos</h2>
 {{-- Botón para insertar --}}
    <div style="height: 50px; margin-bottom: 15px;">
       <a href="{{ route('partido.create') }}" id="insert-btn" class="btn-insertar">
    + Insertar Partidos
</a>

<x-alert-insert :buttonId="'insert-btn'" />

    </div>
    <table class="tabla-usuarios">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Rival</th>
                <th>Resultado</th>
                <th>Torneo</th>
                <th>Equipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($partidos as $partido)
                <tr>
                    <td>{{ $partido->id_partido }}</td>
                    <td>{{ $partido->fecha }}</td>
                    <td>{{ $partido->hora }}</td>
                    <td>{{ $partido->rival }}</td>
                    <td>{{ $partido->resultado }}</td>
                    <td>{{ $partido->torneo->nombre ?? '' }}</td>
                    <td>{{ $partido->equipo->nombre_equipo ?? '' }}</td>
                    <td>
                        <a href="{{ route('partido.edit', $partido) }}" class="btn btn-warning">✏️ Editar</a>
                        <form action="{{ route('partido.destroy', $partido) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar este partido?')" class="btn btn-danger">
                                🗑 Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">No hay partidos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection
