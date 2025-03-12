<?php
class CourseController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodosLosCursos() {
        $query = "SELECT id, titulo FROM cursos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTodosLosTalleres() {
        $query = "SELECT id, nombre FROM talleres";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTodosLosAcompanamientos() {
        $query = "SELECT id, nombre FROM acompanamientos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTodosLosProfesores() {
        $query = "SELECT id, nombre FROM profesores";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarCurso($nombre, $descripcion, $fecha_inicio, $fecha_fin, $profesor_id) {
        $query = "INSERT INTO cursos (nombre, descripcion, fecha_inicio, fecha_fin, profesor_id) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':profesor_id', $profesor_id);
        return $stmt->execute();
    }

    public function agregarTaller($nombre, $descripcion, $fecha_inicio, $fecha_fin, $profesor_id) {
        $query = "INSERT INTO talleres (nombre, descripcion, fecha_inicio, fecha_fin, profesor_id) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':profesor_id', $profesor_id);
        return $stmt->execute();
    }

    public function agregarAcompanamiento($nombre, $descripcion, $fecha_inicio, $fecha_fin, $profesor_id) {
        $query = "INSERT INTO acompanamientos (nombre, descripcion, fecha_inicio, fecha_fin, profesor_id) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :profesor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        $stmt->bindParam(':profesor_id', $profesor_id);
        return $stmt->execute();
    }
}