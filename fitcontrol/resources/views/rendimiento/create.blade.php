@extends('layouts.app')

@section('title', 'Crear Rendimiento')

@section('content')
<div class="card">
    <h2>Crear Rendimiento</h2>
    <form action="{{ route('rendimiento.store') }}" method="POST">
        @csrf
        @include('rendimiento.form', ['rendimiento' => null])
    </form>
</div>
@endsection
