<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
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

    .login-container {
      background-color: #154334;
      padding: 2.5rem;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
      position: relative;
    }

    .logo-container {
      position: relative;
      height: 40px;
      margin-bottom: 1.2rem;
    }

    .login-logo {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 280px;
      max-width: 90vw;
      height: auto;
      object-fit: contain;
      pointer-events: none;
    }

    .login-title {
      color: #f4f5f7;
      text-align: center;
      margin-bottom: 1.8rem;
      font-size: 1.8rem;
      font-weight: 600;
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
      border-color: #c0392b;
      box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.3);
    }

    .error-message {
      color: #ffb4a8;
      font-size: 0.8rem;
      margin-top: 0.35rem;
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

    .login-btn {
      width: 100%;
      padding: 0.8rem;
      background-color: #0c2b20;
      color: #f4f5f7;
      border: 1px solid rgba(244, 245, 247, 0.2);
      border-radius: 6px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      margin-top: 1rem;
      transition: background-color 0.2s, transform 0.1s;
    }

    .login-btn:hover {
      background-color: #081d16;
    }

    .login-btn:active {
      transform: scale(0.98);
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="logo-container">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" class="login-logo">
    </div>

    <h2 class="login-title">Iniciar Sesión</h2>

    @if (session('status'))
      <div class="status-message">
        {{ session('status') }}
      </div>
    @endif

    <form id="loginForm" method="POST" action="{{ route('login') }}">
      @csrf

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
          autofocus
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
        >
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="login-btn">Ingresar</button>
    </form>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;

      const emailRegex = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;

      if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Ingresa un correo electrónico válido.');
        return;
      }

      if (password === '') {
        e.preventDefault();
        alert('Por favor, ingresa tu contraseña.');
        return;
      }
      // Si pasa la validación, el formulario se envía normalmente al servidor
    });
  </script>

</body>
</html>