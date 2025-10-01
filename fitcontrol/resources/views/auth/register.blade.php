<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registro de Usuario | FitControl</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(135deg, #4A90E2, #50a8e3ff);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .register-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 2.5rem 2.5rem 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            max-width: 400px;
            width: 100%;
        }

        .register-card h3 {
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 2rem;
            letter-spacing: 1.2px;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 600;
            color: #555;
            display: block;
            margin-bottom: 0.6rem;
        }

        .form-control {
            padding-left: 2.8rem;
            height: 45px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1.5px solid #ced4da;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 6px rgba(74, 144, 226, 0.5);
            outline: none;
        }

        .form-group .bi {
            position: absolute;
            top: 38px;
            left: 12px;
            color: #a0a0a0;
            font-size: 1.3rem;
            pointer-events: none;
        }

        .error-text {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 0.3rem;
        }

        .btn-primary {
            background-color: #4a90e2;
            border-color: #4a90e2;
            font-weight: 600;
            border-radius: 8px;
            height: 45px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #357ABD;
            border-color: #357ABD;
        }

        .btn-outline-secondary {
            margin-top: 1rem;
            border-radius: 8px;
            width: 100%;
            height: 45px;
            font-weight: 600;
        }

        .error-messages {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 1rem 1.25rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="register-card">
        @if ($errors->any())
            <div class="error-messages">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h3>Registro de Usuario</h3>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <i class="bi bi-person-fill"></i>
                <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required autofocus />
                @error('nombre')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email_usu">Correo Electrónico</label>
                <i class="bi bi-envelope-fill"></i>
                <input id="email_usu" type="email" name="email_usu" value="{{ old('email_usu') }}" class="form-control" required />
                @error('email_usu')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="contra_usu">Contraseña</label>
                <i class="bi bi-lock-fill"></i>
                <input id="contra_usu" type="password" name="contra_usu" class="form-control" required />
                @error('contra_usu')
                    <div class="error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="contra_usu_confirmation">Confirmar Contraseña</label>
                <i class="bi bi-lock-fill"></i>
                <input id="contra_usu_confirmation" type="password" name="contra_usu_confirmation" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-primary">Registrarse</button>

            <a href="{{ route('login') }}" class="btn btn-outline-secondary mt-3">Iniciar Sesión</a>
            <!-- Botón volver al home -->
        <a href="{{ url('/') }}" class="btn btn-link w-100 text-center mt-3">
        ← Volver al inicio
            </a>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
