@extends('layouts.app')

@section('title', 'Editar Inscripción')

@section('content')
<div class="card">
    <h2>Editar Inscripción</h2>
    <form action="{{ route('inscripcion.update', $inscripcion->id_inscripcion) }}" method="POST">
        @csrf
        @method('PUT')
        @include('inscripcion._form', ['inscripcion' => $inscripcion, 'usuarios' => $usuarios, 'torneos' => $torneos])
    </form>
</div>
@endsection
