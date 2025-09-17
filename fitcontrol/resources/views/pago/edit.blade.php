@extends('layouts.app')

@section('title', 'Editar Pago')

@section('content')
<div class="card">
    <h2>Editar Pago</h2>
    <form action="{{ route('pago.update', $pago->id_pago) }}" method="POST">
        @csrf
        @method('PUT')
        @include('pago._form', ['pago' => $pago])
    </form>
</div>
@endsection
