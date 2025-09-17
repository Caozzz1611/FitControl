@extends('layouts.app')

@section('title', 'Editar Asistencia Entrenamiento')

@section('content')
<div class="card">
    <h2>Editar Asistencia Entrenamiento</h2>
    <form action="{{ route('asistencia_entrenamiento.update', $asistencia_entrenamiento->id_asistencia) }}" method="POST">
        @csrf
        @method('PUT')
        @include('asistencia_entrenamiento._form', ['asistencia_entrenamiento' => $asistencia_entrenamiento, 'usuarios' => $usuarios, 'entrenamientos' => $entrenamientos])
    </form>
</div>
@endsection
