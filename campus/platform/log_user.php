<?php
// Conexión a la base de datos
// Hostinger 
$host = 'localhost';
$dbname = 'u810780627_ubuntudb';
$user = 'u810780627_ubuntudb';
$password = 'Ubuntu2020sql';

// Localhost
/*
$host = 'localhost';
$dbname = 'ubuntudb';
$user = 'root';
$password = "";
*/

// Iniciar sesión
session_start();

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Preparar y ejecutar consulta
$stmt = $conn->prepare("SELECT id, nombre, password, role FROM usuarios WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verificar la contraseña
    if (password_verify($password, $user['password'])) {
        // Iniciar sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_role'] = $user['role']; // Guardar el rol en la sesión
        
        // Redirigir según el rol
        if ($_SESSION['user_role'] === 'admin') {
            header("Location: ../users/content/admin/dashboardAdmin.php");
            exit();
        } else {
            if ($_SESSION['user_name'] === "laura Garcia" && $_SESSION['user_id'] == 5) {
                header("Location: ../users/content/alumn/LauraG");
                exit();
            } else {
                header("Location: ../users/dashboardAlumno.php");
                exit();
            }
        }
    } else {
        // Contraseña incorrecta
        header("Location: ../platform/login.php?error=wrong_password");
        exit();
    }
} else {
    // Usuario no encontrado
    header("Location: ../platform/login.php?error=user_not_found");
    exit();
}

$conn->close();
?>
