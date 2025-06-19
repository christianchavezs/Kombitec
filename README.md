# Kombitec

## Descripción
Sistema PHP que muestra y edita productos en MySQL, y se sincroniza para SQL Server.

## Instalación
1. Clonar el repositorio:

2. Importar el backup SQL Server:
- Abrir SSMS → Tasks → Restore → From Device → seleccionar `backups/Articulos_SQL.bak`

3. Ejecutar el script MySQL (`mysql_schema.sql`) en phpMyAdmin o MySQL CLI.
4. Configurar credenciales en `config/config.php`.
5. Asegurarse de que Apache, MySQL y SQL Server estén corriendo.
6. Acceder a `http://localhost/Kombitec/login/index.php` e iniciar sesión con `admin/admin123`.


## Estructura del proyecto
- `assets/` – Estilos e imágenes
- `config/` – Archivo de conexiones y configuración
- `login/`, `productos/`, `editar/`, `sincronizador/` – Módulos de la aplicación
- `backups/Articulos_SQL.bak` – Backup de SQL Server
- `mysql_schema.sql` – Script de creación de base MySQL
