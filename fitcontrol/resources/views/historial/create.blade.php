@extends('layouts.app')

@section('title', 'Nuevo Historial Médico')

@section('content')
    <form action="{{ route('historial.store') }}" method="POST">
        @csrf
        {{-- pasamos explícitamente historial = null --}}
        @include('historial.form', ['historial' => null])
    </form>
@endsection
