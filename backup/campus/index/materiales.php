<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'alumn') {
    header("Location: ../platform/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Materiales</title>
    <style>
        .content-container {
            padding: 20px;
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
                    <a class="nav-link" href="../platform/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-container">
        <h2>Materiales de Curso</h2>
        <p>Aquí puedes acceder a los materiales de tus cursos. Estos pueden incluir documentos, presentaciones y otros recursos.</p>
        <!-- Aquí podrías agregar un código PHP para listar los materiales desde la base de datos -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
