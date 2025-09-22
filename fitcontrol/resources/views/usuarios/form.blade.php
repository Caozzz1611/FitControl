{{-- resources/views/usuarios/form.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($usuario) && $usuario->id_usu ? 'Editar Usuario' : 'Crear Usuario' }}</title>
    <style>
        form {
            max-width: 1000px;
            margin: 30px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.08);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 4px;
            font-size: 14px;
            color: #444;
        }
        .hint {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }
        .form-group input,
        .form-group select {
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0px 0px 6px rgba(0,123,255,0.2);
        }
        .form-group img {
            margin-top: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            max-width: 120px;
        }
        button {
            grid-column: span 3;
            background: #007bff;
            color: #fff;
            padding: 14px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
        .password-wrapper .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-wrapper input {
            width: 100%;
            padding-right: 44px;
        }
        .password-wrapper .toggle-password {
            position: absolute;
            right: 12px;
            cursor: pointer;
            font-size: 18px;
            color: #555;
            user-select: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 6px;
        }
        .password-wrapper .toggle-password:hover {
            color: #007bff;
            background: rgba(0,123,255,0.05);
        }
        .error {
            color: red;
            font-size: 0.85rem;
            margin-top: 4px;
        }
    </style>
</head>
<body>

    <form method="POST"
          action="{{ isset($usuario) && $usuario->id_usu ? route('usuarios.update', $usuario->id_usu) : route('usuarios.store') }}"
          enctype="multipart/form-data"
          novalidate
    >
        @csrf
        @if(isset($usuario) && $usuario->id_usu)
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Nombre</label>
            <input
                type="text"
                name="nombre"
                value="{{ old('nombre', optional($usuario)->nombre) }}"
                required
                pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                title="Solo texto"
            >
            @error('nombre')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Debe ingresar el primer nombre (solo texto).</span>
        </div>

        <div class="form-group">
            <label>Apellido</label>
            <input
                type="text"
                name="apellido"
                value="{{ old('apellido', optional($usuario)->apellido) }}"
                required
                pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+"
                title="Solo texto"
            >
            @error('apellido')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Debe ingresar el primer apellido (solo texto).</span>
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <input
                type="text"
                name="direccion"
                value="{{ old('direccion', optional($usuario)->direccion) }}"
            >
            @error('direccion')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Ingrese su dirección completa.</span>
        </div>

        <div class="form-group">
            <label>Edad</label>
            <input
                type="number"
                name="edad"
                value="{{ old('edad', optional($usuario)->edad) }}"
                min="1"
                max="120"
            >
            @error('edad')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Debe ser un número mayor a 0.</span>
        </div>

        <div class="form-group">
            <label>Foto de Perfil</label>
            <input type="file" name="foto_perfil" accept="image/png,image/jpeg,image/jpg">
            @if(optional($usuario)->foto_perfil)
                <img src="{{ asset('storage/' . $usuario->foto_perfil) }}" alt="Foto Perfil">
            @endif
            @error('foto_perfil')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Formato permitido: JPG, PNG.</span>
        </div>

        <div class="form-group">
            <label>Posición</label>
            <input
                type="text"
                name="posicion"
                value="{{ old('posicion', optional($usuario)->posicion) }}"
            >
            @error('posicion')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Ejemplo: Defensa, Portero, Delantero.</span>
        </div>

        <div class="form-group">
            <label>Categoría</label>
            <input
                type="text"
                name="categoria"
                value="{{ old('categoria', optional($usuario)->categoria) }}"
            >
            @error('categoria')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Ejemplo: Sub-15, Sub-20, Profesional.</span>
        </div>

        <div class="form-group">
            <label>Documento Identidad</label>
            <input
                type="text"
                name="documento_identidad"
                value="{{ old('documento_identidad', optional($usuario)->documento_identidad) }}"
                required
            >
            @error('documento_identidad')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Ingrese su número de identificación.</span>
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input
                type="text"
                name="tel_usu"
                value="{{ old('tel_usu', optional($usuario)->tel_usu) }}"
                pattern="^\d{7,15}$"
                title="Debe contener entre 7 y 15 dígitos."
            >
            @error('tel_usu')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Debe contener entre 7 y 15 dígitos.</span>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email_usu"
                value="{{ old('email_usu', optional($usuario)->email_usu) }}"
                required
            >
            @error('email_usu')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Formato válido: ejemplo@correo.com.</span>
        </div>

        <div class="form-group password-wrapper">
            <label>Contraseña</label>
            <div class="input-container">
                <input
                    type="password"
                    name="contra_usu"
                    id="contra_usu"
                    placeholder="Contraseña"
                    @if(!isset($usuario) || !$usuario->id_usu) required @endif
                    pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}$"
                    title="Mínimo 6 caracteres, incluir mayúscula, número y carácter especial."
                >
                <span
                    class="toggle-password"
                    role="button"
                    tabindex="0"
                    onclick="togglePassword()"
                    onkeypress="if(event.key==='Enter' || event.key===' ') togglePassword()"
                >
                    👁️
                </span>
            </div>
            @error('contra_usu')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Mínimo 6 caracteres, incluir mayúscula, número y carácter especial.</span>
        </div>

        <div class="form-group">
            <label>Rol</label>
            <select name="rol" required>
                <option value="">-- Seleccione un rol --</option>
                <option value="admin" {{ old('rol', $usuario->rol ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="jugador" {{ old('rol', $usuario->rol ?? '') == 'jugador' ? 'selected' : '' }}>Jugador</option>
                <option value="entrenador" {{ old('rol', $usuario->rol ?? '') == 'entrenador' ? 'selected' : '' }}>Entrenador</option>
            </select>
            @error('rol')
                <div class="error">{{ $message }}</div>
            @enderror
            <span class="hint">Seleccione uno: Admin, Jugador o Entrenador.</span>
        </div>

        <button type="submit">Guardar</button>
    </form>

<script>
    function togglePassword() {
        const input = document.getElementById('contra_usu');
        if (!input) return;
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>
