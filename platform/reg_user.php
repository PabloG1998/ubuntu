<?php
// Conexión a la base de datos
require '../vendor/autoload.php';
// Localhost

$host = 'localhost';
$dbname = "ubuntu";
$user = "root";
$password = "";

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['password-confirm'];
$telefono = $_POST['telefono'];

// Santizar
$nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$telefono = preg_replace("/[^0-9]/", "", $telefono);

// Validación de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico no es válido");
}

// Validar los datos del formulario
if (empty($nombre) || empty($email) || empty($password) || empty($passwordConfirm) || empty($telefono)) {
    die("Por favor, complete todos los campos.");
}

// Validación de las contraseñas
if ($password !== $passwordConfirm) {
    die("Las contraseñas no coinciden.");
}

// Hashear la contraseña solo después de la validación
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparar y ejecutar la consulta para insertar el nuevo usuario
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, telefono) VALUES (?, ?, ?, ?)");
$stmt->bind_param('ssss', $nombre, $email, $hashed_password, $telefono);

if ($stmt->execute()) {
    echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
} else {
    echo "Error en el registro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
