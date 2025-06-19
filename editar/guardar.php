<?php
session_start();
require_once __DIR__ . '/../config/config.php';
if (empty($_SESSION['user'])) {
    header('Location: ../login/index.php');
    exit;
}

// Recolección datos
$ids    = array_keys($_POST['nombre'] ?? []);
$names  = $_POST['nombre'] ?? [];
$descs  = $_POST['descripcion'] ?? [];
$prices = $_POST['precio'] ?? [];
$paths  = $_POST['rutaimagen'] ?? [];

if (empty($ids)) {
    die('No hay datos para actualizar.');
}

$stmt = $pdoMy->prepare(
  'UPDATE articulos
   SET Nombre = ?, Descripcion = ?, Precio = ?, RutaImagen = ?
   WHERE IdArticulo = ?'
);

// Generar CSV en memoria
$filename = 'productos_editados_' . date('Ymd_His') . '.csv';
$fp = fopen(__DIR__ . '/' . $filename, 'w');
fputcsv($fp, ['IdArticulo','Nombre','Descripcion','Precio','RutaImagen']);

try {
  foreach ($ids as $id) {
    $n = trim($names[$id]);
    $d = trim($descs[$id]);
    $p = number_format((float)$prices[$id], 2, '.', '');
    $r = trim($paths[$id]);

    $stmt->execute([$n, $d, $p, $r, $id]);
    fputcsv($fp, [$id, $n, $d, $p, $r]);
  }
  fclose($fp);
} catch (PDOException $e) {
  die('Error al actualizar: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualización Completa - Kombitec</title>
  <link rel="stylesheet" href="/Kombitec/assets/css/style.css">
</head>
<body>
  <nav>
    <div class="container">
      <div class="nav-left">
        <img class="logo" src="/Kombitec/assets/img/kombitecmx_logo.jpeg" alt="Kombitec Logo">
        <span class="welcome">Bienvenido, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong></span>
      </div>
      <div class="nav-links">
        <a href="index.php">Volver a Edición</a>
        <a href="/Kombitec/productos/index.php">Productos</a>
        <a href="/Kombitec/logout.php">Cerrar Sesión</a>
      </div>
    </div>
  </nav>

  <div class="container">
    <h2>Actualización exitosa</h2>
    <p><a class="btn" href="<?= htmlspecialchars($filename) ?>" download>Descargar CSV de cambios</a></p>
  </div>
</body>
</html>
