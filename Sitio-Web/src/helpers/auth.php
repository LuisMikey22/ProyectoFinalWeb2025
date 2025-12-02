<?php

function isLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_PATH . '/login');
        exit();
    }
}

function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    require_once __DIR__ . '/../Models/Users.php';
    $pdo = getPDO();
    $userModel = new Users($pdo);
    
    return $userModel->view($_SESSION['user_id']);
}

function isAdmin() {
    $user = getCurrentUser();
    
    if (!$user) {
        return false;
    }
    
    return strtolower($user->rol) === 'admin';
}

function requireAdmin() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_PATH . '/login');
        exit();
    }
    
    if (!isAdmin()) {
        http_response_code(403);
        view('errors/403');
        exit();
    }
}