@extends('layouts.app')

@section('title', 'Crear Asistencia Entrenamiento')

@section('content')
<div class="card">
    <h2>Crear Asistencia Entrenamiento</h2>
    <form action="{{ route('asistencia_entrenamiento.store') }}" method="POST">
        @csrf
        @include('asistencia_entrenamiento._form', ['asistencia_entrenamiento' => null, 'usuarios' => $usuarios, 'entrenamientos' => $entrenamientos])
    </form>
</div>
@endsection
