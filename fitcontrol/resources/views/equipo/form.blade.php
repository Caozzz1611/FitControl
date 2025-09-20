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

        /* estilos para el toggle de contraseña (ojito) */
        .password-wrapper .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 44px; /* espacio para el ojito */
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

        .btn-back {
            grid-column: span 3;
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
        }
    </style>
<div class="form-group">
    <label>Nombre del Equipo</label>
    <input type="text" name="nombre_equipo" 
           value="{{ old('nombre_equipo', optional($equipo)->nombre_equipo) }}" required>
    <span class="hint">Ingrese el nombre completo del equipo.</span>
</div>

<div class="form-group">
    <label>Logo del Equipo (URL o nombre de archivo)</label>
    <input type="text" name="logo_equipo" 
           value="{{ old('logo_equipo', optional($equipo)->logo_equipo) }}">
    <span class="hint">Ingrese la URL o el nombre del archivo del logo del equipo (opcional).</span>
</div>

<div class="form-group">
    <label>Ubicación</label>
    <input type="text" name="ubi_equipo" 
           value="{{ old('ubi_equipo', optional($equipo)->ubi_equipo) }}">
    <span class="hint">Ingrese la ciudad o región donde se encuentra el equipo.</span>
</div>

<div class="form-group">
    <label>Contacto</label>
    <input type="number" name="contacto_equipo" 
           value="{{ old('contacto_equipo', optional($equipo)->contacto_equipo) }}">
    <span class="hint">Ingrese un número de contacto del equipo.</span>
</div>

<div class="form-group">
    <label>Categoría</label>
    <input type="number" name="categoria_equipo" 
           value="{{ old('categoria_equipo', optional($equipo)->categoria_equipo) }}">
    <span class="hint">Ingrese la categoría o nivel del equipo.</span>
</div>

<button type="submit">Guardar</button>
<a href="{{ url()->previous() }}" class="btn-back">← Volver</a>
