<?php
// Conexión a la base de datos
//Hostinger 

$host = 'localhost';
$dbname = 'u810780627_ubuntudb';
$user = 'u810780627_ubuntudb';
$password = 'Ubuntu2020sql';
/*
//Localhost
// Configuración de la base de datos

$host = 'localhost';
$dbname = 'ubuntudb';
$user = 'root';
$password = "";
*/
// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si los datos del formulario están definidos
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    die("Datos incompletos.");
}

$email = $_POST['email'];
$password = $_POST['password'];

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
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_role'] = $user['role'];

        // Redirigir según el rol
        if ($_SESSION['user_role'] === 'admin') {
            header("Location: ../users/content/admin/dashboardAdmin.php");
        } elseif ($_SESSION['user_name'] === 'laura Garcia' && $_SESSION['user_id'] == 5) {
            header("Location: ../users/content/alumn/lauraG");
        } elseif ($_SESSION['user_name'] === 'Natalia Soledad Tarrida' && $_SESSION['user_id'] == 7) {
            header("Location: ../users/content/alumn/nataliaST");
        } else {
            echo "<script>alert('Rol no definido.')</script>";
            header("Location: ../platform/login.php");
        }
        exit();
    } else {
        echo "<script>alert('Contraseña incorrecta.')</script>";
        header("Location: ../platform/login.php");
    }
} else {
    echo "<script>alert('Usuario no encontrado.')</script>";
    header("Location: ../platform/login.php");
}

$conn->close();
?>
