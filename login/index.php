<?php
// login/index.php
session_start();
require_once __DIR__ . '/../config/config.php';
$error = isset($_GET['error']) && $_GET['error'] === '1';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - Kombitec</title>
  <link rel="stylesheet" href="/Kombitec/assets/css/style.css">
</head>
<body>
  <div class="login-container">
    <header>
      <img src="/Kombitec/assets/img/kombitecmx_logo.jpeg" alt="Kombitec Logo">
      <h2>Iniciar Sesión</h2>
    </header>
    <form action="auth.php" method="post">
      <?php if ($error): ?>
        <div class="error">Usuario o contraseña incorrectos.</div>
      <?php endif; ?>
      <input type="text"  name="usuario" placeholder="Usuario" required autofocus>
      <input type="password" name="clave"   placeholder="Contraseña" required>
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>
