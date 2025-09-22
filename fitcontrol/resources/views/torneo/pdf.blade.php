<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Torneos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Reporte de Torneos</h1>

    @foreach ($torneos as $torneo)
        <h2>Torneo: {{ $torneo->nombre }}</h2>

        <table>
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Usuarios</th>
                    <th>Pagos Realizados</th>
                </tr>
            </thead>
            <tbody>
@foreach ($torneos as $torneo)
    <tr>
        <td>{{ $torneo->nombre }}</td>
        <td>{{ $torneo->premio }}</td>
        <td>{{ $torneo->descripcion }}</td>
        <td>{{ $torneo->fecha_inicio }}</td>
        <td>{{ $torneo->fecha_fin }}</td>
        <td>
            @if ($torneo->equipo)
                {{ $torneo->equipo->nombre }}
            @else
                No asignado
            @endif
        </td>
    </tr>
@endforeach

            </tbody>
        </table>

        <hr>
    @endforeach
</body>
</html>
