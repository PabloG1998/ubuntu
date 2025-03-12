<?php

class ConfiguracionController {
    private $db;
    private $id;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Método para obtener la configuración actual
    public function obtenerConfiguracion() {
        try {
            $query = "SELECT * FROM configuracion LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $configuracion = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($configuracion) {
                return $configuracion;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Mostrar el mensaje de error
            echo 'Error en la consulta: ' . $e->getMessage();
            return false;
        }
    }

    // Método para actualizar la configuración
    public function actualizarConfiguracion($email, $smtp_server, $smtp_port, $timezone) {
        try {
            $stmt = $this->db->prepare("UPDATE configuracion SET email = :email, smtp_server = :smtp_server, smtp_port = :smtp_port, timezone = :timezone WHERE id = 1");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':smtp_server', $smtp_server, PDO::PARAM_STR);
            $stmt->bindParam(':smtp_port', $smtp_port, PDO::PARAM_INT);
            $stmt->bindParam(':timezone', $timezone, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //Método para obtener el Personal
    public function obtenerTodoElPersonal() {
        $query = "SELECT * FROM personal";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Agregar personal
    public function agregarPersonal($nombre, $apellido, $mail, $telefono, $cargo) {
        $query = "INSERT INTO personal (nombre, apellido, mail, telefono, cargo)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nombre, $apellido, $mail, $telefono, $cargo]);
    }

    //Eliminar personal
    public function eliminarPersonal($id){
        $query = "DELETE FROM personal WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);

    }

    //Modificar Personal
    public function modificarPersonal($id, $nombre, $apellido, $mail, $telefono, $cargo) {
        $query = "UPDATE personal 
                  SET nombre = ?, apellido = ?, mail = ?, telefono = ?, cargo = ? 
                  WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$nombre, $apellido, $mail, $telefono, $cargo, $id]);
    }
}
?>