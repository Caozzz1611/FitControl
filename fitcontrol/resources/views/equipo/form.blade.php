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
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    background: #0056b3;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease;
}
    </style>
<form id="formEquipo" action="{{ isset($equipo) ? route('equipo.update', $equipo->id_equipo) : route('equipo.store') }}" method="POST" novalidate>
    @csrf
    @if(isset($equipo))
        @method('PUT')
    @endif

    <!-- Nombre del Equipo -->
    <div class="form-group">
        <label>Nombre del Equipo</label>
        <input 
            type="text" 
            name="nombre_equipo" 
            value="{{ old('nombre_equipo', optional($equipo)->nombre_equipo) }}" 
            required
            pattern="[A-Za-z0-9\s]+" 
            title="Debe ingresar solo texto y números."
        >
        @error('nombre_equipo')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <span class="hint">Ingrese el nombre completo del equipo.</span>
    </div>

    <!-- Logo del Equipo -->
    <div class="form-group">
        <label>Logo del Equipo (URL o nombre de archivo)</label>
        <input 
            type="text" 
            name="logo_equipo" 
            value="{{ old('logo_equipo', optional($equipo)->logo_equipo) }}"
            pattern="https?://.+|.+\.(jpg|jpeg|png|gif)"
            title="Ingrese una URL válida o el nombre del archivo de imagen"
        >
        @error('logo_equipo')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <span class="hint">Ingrese la URL o el nombre del archivo del logo del equipo (opcional).</span>
    </div>

    <!-- Ubicación -->
    <div class="form-group">
        <label>Ubicación</label>
        <input 
            type="text" 
            name="ubi_equipo" 
            value="{{ old('ubi_equipo', optional($equipo)->ubi_equipo) }}"
            required
        >
        @error('ubi_equipo')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <span class="hint">Ingrese la ciudad o región donde se encuentra el equipo.</span>
    </div>

    <!-- Contacto -->
    <div class="form-group">
        <label>Contacto</label>
        <input 
            type="number" 
            name="contacto_equipo" 
            value="{{ old('contacto_equipo', optional($equipo)->contacto_equipo) }}"
            required
            min="1000000" 
            max="999999999999999" 
        >
        @error('contacto_equipo')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <span class="hint">Ingrese un número de contacto del equipo.</span>
    </div>

    <!-- Categoría -->
    <div class="form-group">
        <label>Categoría</label>
        <input 
            type="number" 
            name="categoria_equipo" 
            value="{{ old('categoria_equipo', optional($equipo)->categoria_equipo) }}"
            required
        >
        @error('categoria_equipo')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <span class="hint">Ingrese la categoría o nivel del equipo.</span>
    </div>

    <button type="submit">Guardar</button>
    <a href="{{ url()->previous() }}" class="btn-back">← Volver</a>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formEquipo');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;

        // Limpiar errores previos
        form.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
            el.style.display = 'none';
        });

        const nombreEquipo = form.nombre_equipo.value.trim();
        const logoEquipo = form.logo_equipo.value.trim();
        const ubicacion = form.ubi_equipo.value.trim();
        const contacto = form.contacto_equipo.value.trim();
        const categoria = form.categoria_equipo.value.trim();

        // Validaciones

        if (!nombreEquipo) {
            const msg = form.querySelector('input[name="nombre_equipo"] + .error-message');
            msg.textContent = 'El nombre del equipo es obligatorio.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!logoEquipo) {
            const msg = form.querySelector('input[name="logo_equipo"] + .error-message');
            msg.textContent = 'El logo del equipo es opcional, pero si se ingresa debe ser una URL válida o nombre de archivo.';
            msg.style.display = 'block';
        }

        if (!ubicacion) {
            const msg = form.querySelector('input[name="ubi_equipo"] + .error-message');
            msg.textContent = 'La ubicación es obligatoria.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!contacto || contacto.length < 7) {
            const msg = form.querySelector('input[name="contacto_equipo"] + .error-message');
            msg.textContent = 'El número de contacto debe tener entre 7 y 15 dígitos.';
            msg.style.display = 'block';
            valid = false;
        }

        if (!categoria || isNaN(categoria)) {
            const msg = form.querySelector('input[name="categoria_equipo"] + .error-message');
            msg.textContent = 'La categoría debe ser un número.';
            msg.style.display = 'block';
            valid = false;
        }

        if (valid) form.submit();
    });
});
</script>

