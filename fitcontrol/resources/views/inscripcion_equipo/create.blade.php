@extends('layouts.app')

@section('title', 'Crear Inscripción')

@section('content')
    <h2>Crear Inscripción</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inscripcion_equipo.store') }}" method="POST">
        @include('inscripcion_equipo.form')
    </form>
@endsection
