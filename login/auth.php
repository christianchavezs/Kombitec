<?php
// login/auth.php
session_start();

// Cargar configuración
require_once __DIR__ . '/../config/config.php';

// Solo aceptar peticiones POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Usuarios válidos (temporal, puede migrarse a BD)
$validUsers = [
    'admin' => 'admin123',
];

// Recoger y sanitizar datos del formulario
$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$clave   = isset($_POST['clave'])   ? trim($_POST['clave']) : '';

// Validar credenciales
if (isset($validUsers[$usuario]) && $validUsers[$usuario] === $clave) {
    // Inicio de sesión exitoso
    $_SESSION['user'] = $usuario;
    header('Location: ../productos/index.php');
    exit;
} else {
    // Credenciales incorrectas
    header('Location: index.php?error=1');
    exit;
}
