<?php
// app/controllers/HomeController.php
// Controlador para la página principal y gestión de idioma/tema
require_once __DIR__ . '/../models/DatabaseModel.php';

class HomeController {
    // Muestra la página principal con la lista de estudiantes
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $lang = $_SESSION['lang'] ?? 'es';
        $tr = require __DIR__ . '/../../lang/' . $lang . '.php';
        $db = new DatabaseModel();
        $estudiantes = $db->obtenerEstudiantes();
        require_once __DIR__ . '/../views/home/index.php';
    }

    // Cambia el idioma de la sesión
    public function setLang() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $lang = $_GET['lang'] ?? 'es';
        $_SESSION['lang'] = in_array($lang, ['es', 'en']) ? $lang : 'es';
        header('Location: index.php');
        exit();
    }

    // Cambia el tema de la sesión
    public function setTheme() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $theme = $_GET['theme'] ?? 'light';
        $_SESSION['theme'] = in_array($theme, ['light', 'dark']) ? $theme : 'light';
        header('Location: index.php');
        exit();
    }
}
