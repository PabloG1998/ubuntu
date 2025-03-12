<?php
include './db.php';
include '../../resources/controllers/SettingsController.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$dbConnection = $database->getConnection();

if ($dbConnection === null) {
    die('Error: No se pudo establecer una conexión con la base de datos.');
}

// Crear una instancia del controlador de configuración
$configuracionController = new SettingsController($dbConnection);

// Validar y obtener los valores del formulario
$email = $_POST['email'];
$smtp_server = $_POST['smtp_server'];
$smtp_port = $_POST['smtp_port'];
$timezone = $_POST['timezone'];

// Actualizar la configuración
$configuracionController->actualizarConfiguracion($email, $smtp_server, $smtp_port, $timezone);

// Redirigir a la página de configuración con un mensaje de éxito
header('Location: configuracion.php?status=success');
exit();
?>