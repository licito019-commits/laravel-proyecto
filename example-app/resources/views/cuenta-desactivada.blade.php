<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cuenta desactivada · Adversing System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;font-family:'Segoe UI',sans-serif;background:#f5f3ee;color:#16241d;}
        .box{background:#fff;border:1px solid #e3ded2;border-radius:16px;padding:40px 36px;max-width:420px;text-align:center;box-shadow:0 12px 30px rgba(12,43,32,.1);}
        .ic{font-size:44px;margin-bottom:14px;}
        h1{font-size:20px;margin:0 0 10px;color:#0c2b20;}
        p{font-size:14px;color:#5f6f66;line-height:1.6;margin:0 0 22px;}
        a{display:inline-block;background:#0c2b20;color:#fff;text-decoration:none;padding:10px 22px;border-radius:9px;font-size:13px;font-weight:700;}
    </style>
</head>
<body>
    <div class="box">
        <div class="ic">🚫</div>
        <h1>Tu cuenta está desactivada</h1>
        <p>Tu acceso ha sido inhabilitado por un administrador. Si crees que esto es un error, comunícate con Adversing System para más información.</p>
        <a href="{{ route('login') }}">Volver al inicio de sesión</a>
    </div>
</body>
</html>