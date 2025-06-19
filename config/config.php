<?php
// config/config.php
// -----------------
// Archivo de configuración de conexiones para Kombitec
// Provee PDO para MySQL y parámetros para conectar a SQL Server en sync.php

// 1) Iniciar sesión si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2) Conexión a MySQL
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'Articulos_Web');
define('DB_USER', 'root');
define('DB_PASS', 'Viva-mexico1');

try {
    $pdoMy = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Error en conexión MySQL: ' . $e->getMessage());
}

// 3) Parámetros de conexión a SQL Server
//    La conexión en sí se realiza únicamente en sync.php
//define('MSSQL_DSN',      'sqlsrv:Server=BATCOMPUTER\\SQLEXPRESS;Database=Articulos_SQL;TrustServerCertificate=1');
//define('MSSQL_USER',     'syncuser');
//define('MSSQL_PASSWORD', 'SyncPass123!');


// config/config.php (fragmento relevante)
define('MSSQL_DSN',      'sqlsrv:Server=localhost\\SQLEXPRESS;Database=Articulos_SQL;TrustServerCertificate=1');
define('MSSQL_USER',     'syncuser');
define('MSSQL_PASSWORD', 'SyncPass123!');
