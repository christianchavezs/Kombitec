-- mysql_schema.sql

-- 1) Crea BD

CREATE DATABASE IF NOT EXISTS `Articulos_Web`
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
USE `Articulos_Web`;

-- 2) Tabla Productos
CREATE TABLE IF NOT EXISTS `articulos` (
  `IdArticulo` INT NOT NULL,
  `Nombre` VARCHAR(100) NOT NULL,
  `Descripcion` TEXT NULL,
  `Precio` DECIMAL(10,2) NOT NULL,
  `RutaImagen` VARCHAR(255) NULL,
  PRIMARY KEY (`IdArticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
