@extends('layouts.app')

@section('title', 'Reportes')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Reportes Disponibles</h2>

    <div class="reportes-container">
        {{-- Reporte de Usuarios --}}
        <div class="reporte-item">
            <div class="reporte-info">
                <div class="reporte-nombre">
                    <i class="fas fa-users"></i> Reporte de Usuarios
                </div>
                <div class="reporte-descripcion">
                    Listado completo de todos los usuarios registrados en el sistema, con sus datos principales.
                </div>
            </div>
            <a href="{{ route('usuarios.pdf') }}" class="btn btn-pdf">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </a>
        </div>

        {{-- Reporte de Notificaciones --}}
        <div class="reporte-item">
            <div class="reporte-info">
                <div class="reporte-nombre">
                    <i class="fas fa-bell"></i> Reporte de Notificaciones
                </div>
                <div class="reporte-descripcion">
                    Muestra todas las notificaciones enviadas y sus destinatarios dentro del sistema.
                </div>
            </div>
            <a href="{{ route('usuarios.pdf') }}" class="btn btn-pdf">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </a>
        </div>

        {{-- Reporte de Pagos --}}
        <div class="reporte-item">
            <div class="reporte-info">
                <div class="reporte-nombre">
                    <i class="fas fa-money-bill-wave"></i> Reporte de Pagos
                </div>
                <div class="reporte-descripcion">
                    Resumen de todos los pagos realizados por los usuarios, con estado y montos correspondientes.
                </div>
            </div>
            <a href="{{ route('usuarios.pdf') }}" class="btn btn-pdf">
                <i class="fas fa-file-pdf"></i> Descargar PDF
            </a>
        </div>
    </div>
</div>

<style>
.reportes-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.reporte-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    border-radius: 12px;
    background-color: #f8f9fa;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: transform 0.2s, box-shadow 0.2s;
}

.reporte-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
}

.reporte-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.reporte-nombre {
    font-size: 18px;
    font-weight: 600;
    color: #343a40;
    display: flex;
    align-items: center;
    gap: 10px;
}

.reporte-descripcion {
    font-size: 14px;
    color: #6c757d;
}

.btn-pdf {
    background-color: #e74c3c;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.3s, transform 0.2s;
}

.btn-pdf i {
    margin-right: 8px;
}

.btn-pdf:hover {
    background-color: #c0392b;
    transform: scale(1.05);
}
</style>
@endsection
