<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Reporte de Pagos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <!-- Agrega o modifica columnas según campos del modelo Pago -->
            </tr>
        </thead>
        <tbody>
            @forelse($pagos as $pago)
                <tr>
                    <td>{{ $pago->id_pago }}</td>
                    <td>{{ $pago->monto }}</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>{{ $pago->usuario->nombre ?? 'N/A' }}</td>
                    <td>{{ $pago->descripcion }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay pagos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
