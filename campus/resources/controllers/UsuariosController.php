<?php

class UsuariosController {
    private $db;

    // Constructor que inicializa la conexión a la base de datos
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Método para obtener todos los usuarios
    public function obtenerTodosLosUsuarios() {
        try {
            $query = "SELECT * FROM usuarios";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Método para activar un usuario
    public function activarUsuario($id) {
        try {
            $stmt = $this->db->prepare("UPDATE usuarios SET activo = 1 WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Método para desactivar un usuario
    public function desactivarUsuario($id) {
        try {
            $stmt = $this->db->prepare("UPDATE usuarios SET activo = 0 WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Método para obtener un usuario por ID
    public function obtenerUsuarioPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    // Método para actualizar el estado de un usuario
    public function actualizarEstadoUsuario($id, $estado) {
        try {
            $stmt = $this->db->prepare("UPDATE usuarios SET activo = :estado WHERE id = :id");
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Método para guardar un certificado
    public function guardarCertificado($usuario_id, $nombre_usuario, $curso, $archivo_certificado) {
        try {
            $query = "INSERT INTO certificados (usuario_id, nombre_usuario, curso, archivo_certificado) VALUES (:usuario_id, :nombre_usuario, :curso, :archivo_certificado)";
            $stmt = $this->db->prepare($query);
            
            // Bind de los parámetros
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':curso', $curso, PDO::PARAM_STR);
            $stmt->bindParam(':archivo_certificado', $archivo_certificado, PDO::PARAM_STR);
    
            // Ejecutar la consulta
            $stmt->execute();
            
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Método para obtener todos los certificados
    public function obtenerCertificados() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM certificados");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}

?>
