<?php
/**
 * Verifica si el usuario tiene una sesión activa.
 * @return bool
 */
function estaLogueado() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['id_user']);
}

/**
 * Redirige al login si el usuario no está autenticado.
 */
function requerirAutenticacion() {
    if (!estaLogueado()) {
        header('Location: ' . BASE_PATH . '/login');
        exit();
    }
}

/**
 * Verifica si el usuario actual tiene rol de administrador.
 * @return bool
 */
function esAdmin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * Restringe el acceso a rutas administrativas.
 */
function requireAdmin() {
    if (!estaLogueado()) {
        header('Location: ' . BASE_PATH . '/login');
        exit();
    }
    if (!esAdmin()) {
        http_response_code(403);
        view('errors/403');
        exit();
    }
}