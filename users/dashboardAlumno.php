<?php
// conexion.php

//Localhost
$host = 'localhost';
$db = "ubuntu";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los cursos
$sql = "SELECT titulo FROM cursos";
$result = $conn->query($sql);

$cursos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cursos[] = $row['titulo'];
    }
} else {
   // echo "No se encontraron cursos";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Alumno</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .sidebar {
      height: 100vh;
      background-color: #f8f9fa;
      padding-top: 20px;
    }
    .sidebar a {
      padding: 10px;
      display: block;
      color: #333;
      text-decoration: none;
    }
    .sidebar a.active {
      background-color: #007bff;
      color: white;
    }
    .main-content {
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-2 sidebar">
        <h4 class="text-center">Dashboard Alumno</h4>
        <a href="#" class="active">Inicio</a>
        <a href="content/alumn/courses/courses.php">Mis Cursos</a>
        <a href="#">Mis Talleres</a>
        <a href="../campus">Campus Virtual</a> 
       <a href="../config/logout.php">Cerrar Sesión</a>
      </nav>

      <!-- Main Content -->
      <main class="col-md-10 main-content">
        <h1>Bienvenido al Ubuntu</h1>
        <p>Panel del Alumno</p>

        <!-- Example of a section -->
        <section>
        
    </section>

        <!-- Add more sections as needed -->
      </main>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>