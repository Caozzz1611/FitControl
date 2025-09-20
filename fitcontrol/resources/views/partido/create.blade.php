@extends('layouts.app')

@section('title', 'Crear Partido')

@section('content')
<div class="card">
    <h2>Crear Partido</h2>
    <form action="{{ route('partido.store') }}" method="POST">
        @csrf
        {{-- IMPORTANTE: pasar torneo = null para que el partial siempre tenga la variable --}}
        @include('partido.form', ['partido' => null])
    </form>
</div>
<a href="{{ route('partido.index') }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
@endsection
