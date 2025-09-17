@extends('layouts.app')

@section('title', 'Crear Inscripción')

@section('content')
<div class="card">
    <h2>Crear Inscripción</h2>
    <form action="{{ route('inscripcion.store') }}" method="POST">
        @csrf
        @include('inscripcion._form', ['inscripcion' => null, 'usuarios' => $usuarios, 'torneos' => $torneos])
    </form>
</div>
@endsection
