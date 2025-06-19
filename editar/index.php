<?php
session_start();
require_once __DIR__ . '/../config/config.php';
if (empty($_SESSION['user'])) {
    header('Location: ../login/index.php');
    exit;
}
$stmt = $pdoMy->query('SELECT * FROM articulos ORDER BY IdArticulo');
$articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Productos - Kombitec</title>
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
    <h2>Editar Productos</h2>
    <div class="form-container">
      <form action="guardar.php" method="post">
        <table class="edit-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Ruta Imagen</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($articulos as $art): ?>
            <tr>
              <td><?= $art['IdArticulo'] ?></td>
              <td>
                <input
                  type="text"
                  name="nombre[<?= $art['IdArticulo'] ?>]"
                  value="<?= htmlspecialchars($art['Nombre']) ?>"
                  required
                >
              </td>
              <td>
                <input
                  type="text"
                  name="descripcion[<?= $art['IdArticulo'] ?>]"
                  value="<?= htmlspecialchars($art['Descripcion']) ?>"
                >
              </td>
              <td>
                <input
                  type="number"
                  name="precio[<?= $art['IdArticulo'] ?>]"
                  value="<?= htmlspecialchars($art['Precio']) ?>"
                  step="0.01"
                  min="0"
                  required
                >
              </td>
              <td>
                <input
                  type="text"
                  name="rutaimagen[<?= $art['IdArticulo'] ?>]"
                  value="<?= htmlspecialchars($art['RutaImagen']) ?>"
                >
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <button type="submit" class="btn">Guardar y Exportar CSV</button>
      </form>
    </div>
  </div>
</body>
</html>
