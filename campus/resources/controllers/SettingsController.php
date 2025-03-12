<?php

class SettingsController {
    private $db;

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
}
?>