<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #000;
            text-align: left;
        }
        th {
            background: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2>Listado de Usuarios</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Documento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id_usu }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->documento_identidad }}</td>
                    <td>{{ $usuario->tel_usu }}</td>
                    <td>{{ $usuario->email_usu }}</td>
                    <td>{{ $usuario->rol }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
