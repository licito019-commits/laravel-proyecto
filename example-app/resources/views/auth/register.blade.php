<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f2f7f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .register-container {
      position: relative;      /* necesario para posicionar el logo dentro */
      background-color: #154334;
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
    }

    /* Espacio reservado y FIJO para el logo. No cambia sin importar el tamaño de la imagen */
    .logo-container {
      position: absolute;
      top: 2.5rem;
      left: 0;
      right: 0;
      height: 70px;             /* alto fijo del área del logo */
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: visible;        /* permite que el logo se salga un poco si es grande, sin mover el fondo */
      pointer-events: none;
    }

    .register-logo {
      max-width: 450px;         /* logo más grande */
      max-height: 400px;        /* limita qué tan alto puede crecer */
      width: auto;
      height: auto;
      object-fit: contain;
    }

    /* Espacio reservado fijo debajo del logo para que el título nunca se mueva */
    .register-title {
      color: #f4f5f7;
      text-align: center;
      margin-top: 95px;         /* deja espacio fijo debajo del área del logo */
      margin-bottom: 1.8rem;
      font-size: 1.8rem;
      font-weight: 600;
    }

    .status-message {
      background-color: rgba(244, 245, 247, 0.15);
      color: #f4f5f7;
      padding: 0.6rem 0.9rem;
      border-radius: 6px;
      font-size: 0.85rem;
      margin-bottom: 1.2rem;
      text-align: center;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    .form-group label {
      display: block;
      color: #f4f5f7;
      margin-bottom: 0.5rem;
      font-size: 0.9rem;
      opacity: 0.9;
    }

    .form-group input {
      width: 100%;
      padding: 0.75rem 1rem;
      border-radius: 6px;
      border: 1px solid transparent;
      background-color: #f4f5f7;
      color: #0c2b20;
      font-size: 1rem;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus {
      border-color: #0c2b20;
      box-shadow: 0 0 0 3px rgba(12, 43, 32, 0.4);
    }

    .form-group input.is-invalid {
      border-color: #e88b7d;
      box-shadow: 0 0 0 3px rgba(232, 139, 125, 0.3);
    }

    .error-message {
      color: #ffb4a8;
      font-size: 0.8rem;
      margin-top: 0.35rem;
    }

    .form-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 1.5rem;
    }

    .form-footer a {
      color: #f4f5f7;
      font-size: 0.85rem;
      text-decoration: underline;
      opacity: 0.85;
    }

    .form-footer a:hover {
      opacity: 1;
    }

    .register-btn {
      padding: 0.7rem 1.4rem;
      background-color: #0c2b20;
      color: #f4f5f7;
      border: 1px solid rgba(244, 245, 247, 0.2);
      border-radius: 6px;
      font-size: 0.9rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s, transform 0.1s;
    }

    .register-btn:hover {
      background-color: #081d16;
    }

    .register-btn:active {
      transform: scale(0.98);
    }
  </style>
</head>
<body>

  <div class="register-container">
    <div class="logo-container">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="register-logo">
    </div>

    <h2 class="register-title">Crear Cuenta</h2>

    @if (session('status'))
      <div class="status-message">
        {{ session('status') }}
      </div>
    @endif

    <form id="registerForm" method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label for="name">Nombre</label>
        <input
          type="text"
          id="name"
          name="name"
          value="{{ old('name') }}"
          placeholder="Tu nombre"
          class="@error('name') is-invalid @enderror"
          required
          autofocus
          autocomplete="name"
        >
        @error('name')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input
          type="email"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="ejemplo@dominio.com"
          class="@error('email') is-invalid @enderror"
          required
          autocomplete="username"
        >
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="••••••••"
          class="@error('password') is-invalid @enderror"
          required
          autocomplete="new-password"
        >
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password_confirmation">Confirmar Contraseña</label>
        <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="••••••••"
          required
          autocomplete="new-password"
        >
      </div>

      <div class="form-footer">
        <a href="{{ route('login') }}">¿Ya tienes cuenta?</a>
        <button type="submit" class="register-btn">Registrarse</button>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();

      // El usuario (antes del @) debe tener al menos una letra o un número,
      // el dominio debe existir y terminar exactamente en ".com"
      const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/;

      // El nombre debe contener al menos una letra o un número (no solo espacios/símbolos)
      const nameRegex = /[a-zA-Z0-9]/;

      if (!nameRegex.test(name)) {
        e.preventDefault();
        alert('El nombre debe contener al menos una letra o un número.');
        return;
      }

      if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('El correo debe contener un usuario (letras o números), el símbolo "@" y terminar en ".com".');
        return;
      }
      // Si todo es válido, el formulario se envía normalmente al servidor
    });
  </script>

</body>
</html>