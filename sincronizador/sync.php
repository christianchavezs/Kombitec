<?php
// sincronizador/sync.php
session_start();
require_once __DIR__ . '/../config/config.php';
if (empty($_SESSION['user'])) {
    header('Location: ../login/index.php');
    exit;
}

// Conexión SQL Server
try {
    $pdoSql = new PDO(
        MSSQL_DSN,
        MSSQL_USER,
        MSSQL_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    error_log('Error SQL Server: '.$e->getMessage());
    echo 'Falló la conexión a SQL Server. Revisa los logs.<br>';
    echo '<a class="btn" href="../productos/index.php">Volver a Productos</a>';
    exit;
}

// Sincronización
try {
    $rows = $pdoSql->query(
        'SELECT IdArticulo, Nombre, Descripcion, Precio, RutaImagen FROM Articulos_SQL'
    )->fetchAll(PDO::FETCH_ASSOC);

    $stmtExists = $pdoMy->prepare('SELECT 1 FROM articulos WHERE IdArticulo = ?');
    $stmtInsert = $pdoMy->prepare(
        'INSERT INTO articulos (IdArticulo, Nombre, Descripcion, Precio, RutaImagen)
         VALUES (?, ?, ?, ?, ?)'
    );

    $count = 0;
    foreach ($rows as $art) {
        $stmtExists->execute([$art['IdArticulo']]);
        if (!$stmtExists->fetch()) {
            $stmtInsert->execute([
                $art['IdArticulo'],
                $art['Nombre'],
                $art['Descripcion'],
                $art['Precio'],
                $art['RutaImagen']
            ]);
            $count++;
        }
    }
} catch (PDOException $e) {
    die('Error durante sincronización: '.$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Sincronización - Kombitec</title>
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
    <h2>Sincronización completada</h2>
    <p>Se han insertado <strong><?= $count ?></strong> artículo(s) nuevo(s).</p>
    <p><a class="btn" href="../productos/index.php">Volver a Productos</a></p>
  </div>
</body>
</html>
