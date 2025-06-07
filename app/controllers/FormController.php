<?php
// app/controllers/FormController.php
// Controlador para el formulario de registro de habilidad principal
require_once __DIR__ . '/../models/DatabaseModel.php';

class FormController {
    // Muestra el formulario
    public function show() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $lang = $_SESSION['lang'] ?? 'es';
        $tr = require __DIR__ . '/../../lang/' . $lang . '.php';
        require_once __DIR__ . '/../views/form/index.php';
    }

    // Procesa el guardado de la habilidad principal
    public function save() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $habilidad = trim($_POST['habilidad'] ?? '');
            if (!empty($habilidad)) {
                $db = new DatabaseModel();
                $resultado = $db->crearEstudiante($_SESSION['user_id'], $habilidad);
                if ($resultado === false) {
                    $_SESSION['habilidad_error'] = 'Solo puedes agregar una habilidad principal';
                    header('Location: index.php?route=show_form');
                    exit();
                }
            }
            header('Location: index.php?route=home');
            exit();
        }
    }

    // Muestra el formulario para editar la habilidad principal
    public function edit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        }
        $lang = $_SESSION['lang'] ?? 'es';
        $tr = require __DIR__ . '/../../lang/' . $lang . '.php';
        $db = new DatabaseModel();
        // Obtener la habilidad actual del usuario
        $usuario_id = $_SESSION['user_id'];
        $estudiantes = $db->obtenerEstudiantes();
        $habilidad_principal = '';
        foreach ($estudiantes as $est) {
            if ($est['usuario_id'] == $usuario_id) {
                $habilidad_principal = $est['habilidad_principal'];
                break;
            }
        }
        $editando = true;
        require_once __DIR__ . '/../views/form/index.php';
    }

    // Procesa la actualización de la habilidad principal
    public function update() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $habilidad = trim($_POST['habilidad'] ?? '');
            if (!empty($habilidad)) {
                $db = new DatabaseModel();
                $db->actualizarHabilidad($_SESSION['user_id'], $habilidad);
            }
            header('Location: index.php?route=home');
            exit();
        }
    }

    // Elimina la habilidad principal
    public function delete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        }
        $db = new DatabaseModel();
        $db->eliminarHabilidad($_SESSION['user_id']);
        header('Location: index.php?route=home');
        exit();
    }

    // Descargar PDF del currículum
    public function downloadPdf() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=login');
            exit();
        }
        require_once __DIR__ . '/../../vendor/autoload.php';
        $db = new DatabaseModel();
        $usuario_id = $_SESSION['user_id'];
        $estudiantes = $db->obtenerEstudiantes();
        $usuario = null;
        $habilidad = '';
        foreach ($estudiantes as $est) {
            if ($est['usuario_id'] == $usuario_id) {
                $usuario = $est;
                $habilidad = $est['habilidad_principal'];
                break;
            }
        }
        if (!$usuario) {
            echo 'No hay datos para exportar.';
            exit();
        }
        $html = '<h2 style="color:#185a9d;text-align:center;">TuPortafolio</h2>';
        $html .= '<hr style="margin:18px 0;">';
        $html .= '<p><strong>Nombre:</strong> ' . htmlspecialchars($usuario['nombre']) . '</p>';
        $html .= '<p><strong>Email:</strong> ' . htmlspecialchars($usuario['email']) . '</p>';
        $html .= '<p><strong>Habilidad principal:</strong> ' . htmlspecialchars($habilidad) . '</p>';
        $html .= '<br><p style="font-size:0.95rem;color:#888;text-align:center;">Generado el ' . date('d/m/Y H:i') . '</p>';
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('TuPortafolio.pdf', ["Attachment" => true]);
        exit();
    }
}
