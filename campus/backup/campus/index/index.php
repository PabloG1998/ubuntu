<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../platform/login.php"); // Redirigir al usuario no autenticado
    exit();
}

// Verificar si el usuario es alumno
if ($_SESSION['role'] != 'alumn') {
    header("Location: ../platform/login.php"); // Redirigir si no es alumno
    exit();
}

// Conexion a la Base de Datos
$host = 'localhost'; // Cambia según tu configuración
$db = 'ubuntudb'; // Cambia según tu base de datos
$user = 'root'; // Cambia según tu usuario
$pass = ''; // Cambia según tu contraseña

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
//Obtiene el email
$email = $_SESSION['email'];
//Consulta
$query = "SELECT cursos.nombre, cursos.descripcion 
          FROM cursos 
          JOIN inscripciones ON cursos.id_curso = inscripciones.id
          JOIN usuarios ON inscripciones.id = usuarios.id 
          WHERE usuarios.email = '$email'";

$result = mysqli_query($conn, $query);

$cursos = [];
if($result && mysqli_num_rows($result) >0 ) {
    while($rows = mysqli_fetch_assoc($result)) {
        $cursos[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Campus Virtual</title>
    <style>
        .gradient-custom {
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ffffff;
            padding: 15px 20px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="gradient-custom">

    <div class="sidebar">
        <h2 class="text-center text-white">Campus Virtual</h2>
        <a href="materiales.php">Materiales</a>
      <!--  <a href="#clases-grabadas">Clases Grabadas</a>
        <a href="#examenes">Exámenes</a> -->
        <a href="SendFeedback.php">¡Envianos tus comentarios!</a>
        <a href="../../config/logout.php">Cerrar Sesión</a>
    </div>

    <div class="content">
   
        <h2>Mis Cursos</h2>
        <?php if (count($cursos) > 0): ?>
            <?php foreach ($cursos as $curso): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $curso['nombre']; ?></h5>
                        <p class="card-text"><?php echo $curso['descripcion']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No estás inscrito en ningún curso actualmente.</p>
        <?php endif; ?>
    </div>
   <!--  <div id="materiales">
            <h2>Materiales</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Material 1</h5>
                    <p class="card-text">Descripción del material 1.</p>
                    <a href="materiales.php" class="btn btn-primary">Ver Material</a>
                </div>
            </div>
       
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Material 2</h5>
                    <p class="card-text">Descripción del material 2.</p>
                    <a href="#" class="btn btn-primary">Ver Material</a>
                </div>
            </div>
        </div>

        <div id="clases-grabadas">
            <h2>Clases Grabadas</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Clase 1</h5>
                    <p class="card-text">Descripción de la clase 1.</p>
                    <a href="#" class="btn btn-primary">Ver Clase</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Clase 2</h5>
                    <p class="card-text">Descripción de la clase 2.</p>
                    <a href="#" class="btn btn-primary">Ver Clase</a>
                </div>
            </div>
        </div>

        <div id="examenes">
            <h2>Exámenes</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Examen 1</h5>
                    <p class="card-text">Descripción del examen 1.</p>
                    <a href="#" class="btn btn-primary">Ver Examen</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Examen 2</h5>
                    <p class="card-text">Descripción del examen 2.</p>
                    <a href="#" class="btn btn-primary">Ver Examen</a>
                </div>
            </div>
        </div>
    </div>
        -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
