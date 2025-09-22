@extends('layouts.app')

@section('title', 'Crear Entrenamiento')

@section('content')
<div class="card">
    <h2>Crear Entrenamiento</h2>
    <form action="{{ route('entrenamiento.store') }}" method="POST">
        @csrf
@include('entrenamiento._form', ['entrenamiento' => null])
    </form>
</div>
@endsection
