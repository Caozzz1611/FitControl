@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="card">
    <h2>Crear Usuario</h2>
    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('usuarios.form')
    </form>
</div>

<a href="{{ route('usuarios.index') }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
@endsection
