<?php
// app/controllers/AuthController.php
// Controlador para autenticación de usuarios (login, registro, logout)
// Codificación UTF-8
require_once __DIR__ . '/../models/DatabaseModel.php';

class AuthController {
    // Muestra el formulario de login
    public function showLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $lang = $_SESSION['lang'] ?? 'es';
        $tr = require __DIR__ . '/../../lang/' . $lang . '.php';
        require_once __DIR__ . '/../views/auth/login.php';
    }

    // Procesa el login
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $db = new DatabaseModel();
            $user = $db->obtenerUsuarioPorEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nombre'];
                header('Location: index.php?route=home');
                exit();
            } else {
                $_SESSION['login_error'] = 'Credenciales incorrectas';
                header('Location: index.php?route=login');
                exit();
            }
        }
    }

    // Muestra el formulario de registro
    public function showRegister() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $lang = $_SESSION['lang'] ?? 'es';
        $tr = require __DIR__ . '/../../lang/' . $lang . '.php';
        require_once __DIR__ . '/../views/auth/register.php';
    }

    // Procesa el registro
    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            if (!empty($nombre) && !empty($email) && !empty($password)) {
                $db = new DatabaseModel();
                $existe = $db->obtenerUsuarioPorEmail($email);
                if ($existe) {
                    $_SESSION['register_error'] = 'El correo ya está registrado.';
                    header('Location: index.php?route=register');
                    exit();
                }
                $db->crearUsuario($nombre, $email, $password);
                header('Location: index.php?route=login');
                exit();
            } else {
                $_SESSION['register_error'] = 'Completa todos los campos.';
                header('Location: index.php?route=register');
                exit();
            }
        }
    }

    // Cierra la sesión
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?route=login');
        exit();
    }
}
