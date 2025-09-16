@extends('layouts.app')

@section('title', 'Crear Notificación')

@section('content')
<div class="card">
    <h2>Nueva Notificación</h2>
    <form action="{{ route('notificaciones.store') }}" method="POST">
        @csrf
        @php $notificacion = null; @endphp
        @include('notificaciones.form')
    </form>
</div>

<a href="{{ url()->previous() }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
</a>
@endsection
