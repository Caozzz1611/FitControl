@extends('layouts.app')

@section('title', 'Editar Entrenamiento')

@section('content')
<div class="card">
    <h2>Editar Entrenamiento</h2>
    <form action="{{ route('entrenamiento.update', $entrenamiento->id_entrenamiento) }}" method="POST">
        @csrf
        @method('PUT')
        @include('entrenamiento._form', ['entrenamiento' => $entrenamiento, 'equipos' => $equipos])
    </form>
</div>
@endsection
