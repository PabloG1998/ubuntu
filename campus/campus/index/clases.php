<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'alumn') {
    header("Location: ../platform/login.php");
    exit();
}

// Conexión a la base de datos
$host = 'localhost';
$db = 'ubuntudb';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="shortcut icon" href="../../resources/images/EagSKyL6nmIT5erqWDgzbASr0mrytrYTcFlevFtMJegeA8qwxTpQPhGOr3gchU.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Clases Grabadas</title>
    <style>
        .content-container {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboardAlumno.php">Campus Virtual</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="materiales.php">Materiales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clases.php">Clases Grabadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="examenes.php">Exámenes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../config/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-container">
        <h2>Clases Grabadas</h2>
        <p>Aquí puedes ver las grabaciones de las clases. Puedes acceder a las grabaciones desde los enlaces proporcionados a continuación.</p>

       

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
