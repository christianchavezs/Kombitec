<?php
session_start();
require_once __DIR__ . '/../config/config.php';
if (empty($_SESSION['user'])) {
    header('Location: ../login/index.php');
    exit;
}
$stmt = $pdoMy->query("SELECT * FROM articulos ORDER BY IdArticulo ASC");
$articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos - Kombitec</title>
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
        <a href="/Kombitec/productos/index.php">Productos</a>
        <a href="/Kombitec/editar/index.php">Editar</a>
        <a href="/Kombitec/sincronizador/sync.php">Sincronizar</a>
        <a href="/Kombitec/logout.php">Cerrar Sesión</a>
      </div>
    </div>
  </nav>

  <div class="container">
    <h2>Listado de Productos</h2>

    <?php if (empty($articulos)): ?>
      <p>No hay productos para mostrar.</p>
    <?php else: ?>
      <div class="product-grid">
        <?php foreach ($articulos as $art): ?>
          <div class="card">
            <?php if ($art['RutaImagen']): ?>
              <img src="<?= htmlspecialchars($art['RutaImagen']) ?>"
                   alt="<?= htmlspecialchars($art['Nombre']) ?>">
            <?php endif; ?>
            <div class="card-body">
              <h3><?= htmlspecialchars($art['Nombre']) ?></h3>
              <p><?= nl2br(htmlspecialchars($art['Descripcion'])) ?></p>
              <div class="price">$<?= number_format($art['Precio'], 2) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
