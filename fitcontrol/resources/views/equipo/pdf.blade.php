<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Equipos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h1>Reporte de Equipos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Contacto</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipos as $equipo)
                <tr>
                    <td>{{ $equipo->id_equipo }}</td>
                    <td>{{ $equipo->nombre_equipo }}</td>
                    <td>{{ $equipo->ubi_equipo }}</td>
                    <td>{{ $equipo->contacto_equipo }}</td>
                    <td>{{ $equipo->categoria_equipo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
