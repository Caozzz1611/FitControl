@extends('layouts.app')

@section('title', 'Editar Partido')

@section('content')
<div class="card">
    <h2>Editar Partido</h2>
    <form action="{{ route('partido.update', $partido) }}" method="POST">
        @csrf
        @method('PUT')
        @include('partido.form', ['partido' => $partido])
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<a href="{{ route('partido.index') }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
@endsection
