<?php
require_once __DIR__ . '/config/config.php';

try {
    $pdo = new PDO(
        MSSQL_DSN,
        MSSQL_USER,
        MSSQL_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo 'Conexión a SQL Server OK';
} catch (PDOException $e) {
    echo 'Falló la conexión a SQL Server: ' . $e->getMessage();
}
