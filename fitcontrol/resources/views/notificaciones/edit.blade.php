@extends('layouts.app')

@section('title', 'Editar Notificación')

@section('content')
<div class="card">
    <h2>Editar Notificación</h2>
    <form action="{{ route('notificaciones.update', $notificacion->id_notificacion) }}" method="POST">
        @csrf
        @method('PUT')
        @include('notificaciones.form')
    </form>
</div>
@endsection
