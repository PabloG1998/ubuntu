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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Alumno</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
        <a href="./index.php">Inicio</a>
        <a href="./courses.php" class="active">Mis Cursos</a>
        <a href="./workshops.php">Mis Talleres</a>
        <a href="#">Campus Virtual</a> 
        <a href="../config/logout.php">Cerrar Sesión</a>
      </nav>

      <!-- Main content -->
      <div class="col-md-10 main-content">
        <h1>Mis Inscripciones</h1>
        <table id="inscripcionesTable" class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Curso</th>
            <!--  <th>Fecha de Inscripción</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            // Mostrar los registros
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nombre_completo'] . "</td>";
                    echo "<td>" . $row['curso'] . "</td>";
                    //echo "<td>" . $row['fecha_inscripcion'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay registros.</td></tr>";
            }
            ?>
          </tbody>
        </table>
        
        <!-- Paginación -->
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>

    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#inscripcionesTable').DataTable();
    });
  </script>
  
</body>
</html>
