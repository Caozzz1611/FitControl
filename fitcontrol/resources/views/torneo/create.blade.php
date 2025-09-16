@extends('layouts.app')

@section('title', 'Crear Torneo')

@section('content')
<div class="card">
    <h2>Crear Torneo</h2>
    <form action="{{ route('torneo.store') }}" method="POST">
        @csrf
        {{-- IMPORTANTE: pasar torneo = null para que el partial siempre tenga la variable --}}
        @include('torneo.form', ['torneo' => null])
        <button type="submit">Guardar</button>
    </form>
</div>

<a href="{{ route('torneo.index') }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
@endsection
