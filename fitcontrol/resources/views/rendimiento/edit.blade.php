@extends('layouts.app')

@section('title', 'Editar Rendimiento')

@section('content')
<div class="card">
    <h2>Editar Rendimiento</h2>
    <form action="{{ route('rendimiento.update', $rendimiento) }}" method="POST">
        @csrf
        @method('PUT')
        @include('rendimiento.form', ['rendimiento' => $rendimiento])
    </form>
</div>
@endsection
