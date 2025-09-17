@extends('layouts.app')

@section('title', 'Crear Pago')

@section('content')
<div class="card">
    <h2>Crear Pago</h2>
    <form action="{{ route('pago.store') }}" method="POST">
        @csrf
        @include('pago._form', ['pago' => null])
    </form>
</div>
@endsection
