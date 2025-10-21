<?php
/**
 * Script PHP para identificar tipo de sesión y validar acceso
 * Archivo: static/session/session_validations.php
 * 
 * IMPORTANTE: No debe haber NINGÚN espacio o línea antes de <?php
 * para evitar el error "headers already sent"
 */

switch ($sessiontype) {
    case 'all': // Sin importar el rol de quien está logueado
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['id']) || $_SESSION['id'] <= 0) {
            $pageToRedirect = "login.php";
            header("Location: {$pageToRedirect}");
            exit;
        }
        break;

    case 'anfitrion': // Solo para rol Anfitrión
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Anfitrión') {
            $pageToRedirect = "login.php";
            header("Location: {$pageToRedirect}");
            exit;
        }
        break;

    case 'Administrador': // Solo para rol Administrador
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Administrador') {
            $pageToRedirect = "login.php";
            header("Location: {$pageToRedirect}");
            exit;
        }
        break;

    case 'index': // Página de inicio (accesible para todos)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // No hay restricciones, todos pueden acceder
        break;

    default:
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        break;
}
?>