<?php 

//Hostinger 

$servername = 'localhost';
$dbname = 'u810780627_ubuntudb';
$username = 'u810780627_ubuntudb';
$password = 'Ubuntu2020sql';

/*
//Localhost
$servername = 'localhost';
$dbname = "ubuntudb";
$username = "root";
$password = "";
*/

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configuración de paginación
$limit = 4; // Número de cursos_inscriptos por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual
$offset = ($page - 1) * $limit; // Desplazamiento

// Consulta con paginación
$sql = "SELECT * FROM formulario_inscripcion where email = 'nstarrida@gmail.com' LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Consulta para contar el total de talleres
$total_sql = "SELECT COUNT(*) as total FROM talleres";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_talleres = $total_row['total']; // Total de talleres
$total_pages = ceil($total_talleres / $limit); // Total de páginas

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
        <a href="./courses.php">Mis Cursos</a>
        <a href="./workshops.php">Mis Talleres</a>
        <a href="#">Campus Virtual</a> 
       <a href="../../../../config/logout.php">Cerrar Sesión</a>
      </nav>

      <!-- Main Content -->
      <main class="col-md-10 main-content">
        <h1>Bienvenido</h1>
        <p>Tarrida, Natalia Soledad</p>
        <hr>
        <h2>Cursos a los que se ha inscripto: </h2>
       
        <!-- Content -->
    <div class="row">
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($row['nombre_completo']); ?></h5>
                <p class="card-text"><?php echo htmlspecialchars($row['curso']); ?></p>
                <a class="btn btn-danger" href="#">Inscripto</a>
                <!--<a href="workshop_id/<?php echo $row['id']; ?>/" class="btn btn-primary">Inscripto.</a> -->
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No se encontraron cursos.</p>
               <?php endif; ?>
    </div>

    <br>
    <!-- Paginación -->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $page - 1; ?>">Anterior</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
          <a class="page-link" href="?page=<?php echo $page + 1; ?>">Siguiente</a>
        </li>
      </ul>
    </nav>

    <!-- Footer -->

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