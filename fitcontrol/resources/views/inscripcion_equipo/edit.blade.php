@extends('layouts.app')

@section('title', 'Editar Inscripción')

@section('content')
    <h2>Editar Inscripción</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inscripcion_equipo.update', $inscripcion_equipo) }}" method="POST">
        @method('PUT')
        @include('inscripcion_equipo.form')
    </form>
@endsection
