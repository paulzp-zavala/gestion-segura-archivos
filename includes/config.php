<?php
/**
 * ==========================================================
 * CONFIGURACIÓN GENERAL DEL PROYECTO
 * Gestión Segura de Archivos
 * Desarrollo Web - UTPL
 * ==========================================================
 */

/*=========================================
=            CONFIGURACIÓN GENERAL         =
=========================================*/

date_default_timezone_set('America/Guayaquil');

ini_set('display_errors', 1);
error_reporting(E_ALL);

/*=========================================
=            SESIÓN SEGURA                 =
=========================================*/

if (session_status() === PHP_SESSION_NONE) {

    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'httponly' => true,
        'secure' => false,   // Cambiar a true cuando use HTTPS
        'samesite' => 'Strict'
    ]);

    session_start();
}

/*=========================================
=            BASE DE DATOS                 =
=========================================*/

define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'gestion_archivos_seguro');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/*=========================================
=            DIRECTORIOS                   =
=========================================*/

define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('LOG_DIR', __DIR__ . '/../logs/');

define('BASE_URL', 'http://localhost/gestion_archivos_seguro/');

/*=========================================
=            TAMAÑO MÁXIMO                 =
=========================================*/

define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5 MB

/*=========================================
=            CONEXIÓN PDO                  =
=========================================*/

try {

    $dsn = "mysql:host=" . DB_HOST .
           ";port=" . DB_PORT .
           ";dbname=" . DB_NAME .
           ";charset=" . DB_CHARSET;

    $conexion = new PDO(
        $dsn,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

} catch (PDOException $e) {

    die("Error de conexión: " . $e->getMessage());

}

/*=========================================
=            FUNCIONES GLOBALES            =
=========================================*/

function limpiar($dato)
{
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

function redireccionar($ruta)
{
    header("Location: " . BASE_URL . $ruta);
    exit;
}

function estaLogueado()
{
    return isset($_SESSION['usuario_id']);
}

function registrarLog(PDO $conexion, $accion)
{
    $sql = "INSERT INTO logs (accion) VALUES (:accion)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        'accion' => $accion
    ]);
}