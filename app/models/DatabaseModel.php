<?php
// app/models/DatabaseModel.php
// Modelo para la conexión y operaciones con la base de datos MySQL
class DatabaseModel {
    private $connection;

    // Constructor: establece la conexión a la base de datos
    public function __construct() {
        $this->connection = new mysqli('localhost', 'root', '', 'tuportafolio_db');
        if ($this->connection->connect_error) {
            die("Error de conexión a la base de datos: " . $this->connection->connect_error);
        }
    }

    // Leer todos los estudiantes y su usuario
    public function obtenerEstudiantes() {
        $result = $this->connection->query(
            "SELECT e.*, u.nombre, u.email FROM estudiantes e JOIN usuarios u ON e.usuario_id = u.id ORDER BY e.id DESC"
        );
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Crear estudiante (habilidad principal)
    public function crearEstudiante($usuario_id, $habilidad) {
        // Verificar si el usuario ya tiene una habilidad principal
        $stmt = $this->connection->prepare(
            "SELECT COUNT(*) as total FROM estudiantes WHERE usuario_id = ?"
        );
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res ? $res->fetch_assoc() : null;
        if ($row && $row['total'] > 0) {
            // Ya tiene una habilidad principal, no insertar
            return false;
        }
        $stmt = $this->connection->prepare(
            "INSERT INTO estudiantes (usuario_id, habilidad_principal) VALUES (?, ?)"
        );
        $stmt->bind_param("is", $usuario_id, $habilidad);
        return $stmt->execute();
    }

    // Crear usuario
    public function crearUsuario($nombre, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->connection->prepare(
            "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $nombre, $email, $hash);
        return $stmt->execute();
    }

    // Buscar usuario por email
    public function obtenerUsuarioPorEmail($email) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM usuarios WHERE email = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_assoc() : null;
    }

    // Actualizar habilidad principal
    public function actualizarHabilidad($usuario_id, $habilidad) {
        $stmt = $this->connection->prepare(
            "UPDATE estudiantes SET habilidad_principal = ? WHERE usuario_id = ?"
        );
        $stmt->bind_param("si", $habilidad, $usuario_id);
        return $stmt->execute();
    }

    // Eliminar habilidad principal
    public function eliminarHabilidad($usuario_id) {
        $stmt = $this->connection->prepare(
            "DELETE FROM estudiantes WHERE usuario_id = ?"
        );
        $stmt->bind_param("i", $usuario_id);
        return $stmt->execute();
    }

    // Destructor: cierra la conexión
    public function __destruct() {
        $this->connection->close();
    }
}
