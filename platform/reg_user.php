<?php
// Conexión a la base de datos
//Hostinger

$host = 'localhost';
$dbname = 'u810780627_ubuntudb';
$user = 'u810780627_ubuntudb';
$password = 'Ubuntu2020sql';


//Localhost
/*
$host = 'localhost';
$dbname = "ubuntudb";
$user = "root";
$password = "";
*/
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

// Validar los datos del formulario
if (empty($nombre) || empty($email) || empty($password) || empty($passwordConfirm) || empty($telefono)) {
    die("Por favor, complete todos los campos.");
}

if ($password !== $passwordConfirm) {
    die("Las contraseñas no coinciden.");
}

// Hashear la contraseña
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
