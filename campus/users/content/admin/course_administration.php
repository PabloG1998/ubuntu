<?php
include '../../../resources/controllers/CourseController.php';
include '../../../config/db.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$dbConnection = $database->getConnection();

if ($dbConnection === null) {
    die('Error: No se pudo establecer una conexión con la base de datos.');
}

// Crear una instancia del controlador de cursos con la conexión a la base de datos
$courseController = new CourseController($dbConnection);

// Obtener todos los cursos, talleres, acompañamientos y profesores
$cursos = $courseController->obtenerTodosLosCursos();
$talleres = $courseController->obtenerTodosLosTalleres();
$acompanamientos = $courseController->obtenerTodosLosAcompanamientos();

// Obtener todos los profesores de la tabla 'profesores'
$queryProfesores = "SELECT profesor_id, nombre FROM profesores";
$stmtProfesores = $dbConnection->prepare($queryProfesores);
$stmtProfesores->execute();
$profesores = $stmtProfesores->fetchAll(PDO::FETCH_ASSOC);

// Procesar el formulario de agregar curso, taller o acompañamiento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $profesor_id = $_POST['profesor_id'];
    $tipo = $_POST['tipo'];

    if ($tipo == 'curso') {
        $result = $courseController->agregarCurso($nombre, $descripcion, $fecha_inicio, $fecha_fin, $profesor_id);
    } elseif ($tipo == 'taller') {
        $result = $courseController->agregarTaller($nombre, $descripcion, $fecha_inicio, $fecha_fin, $profesor_id);
    } elseif ($tipo == 'acompanamiento') {
        $result = $courseController->agregarAcompanamiento($nombre, $descripcion, $fecha_inicio, $fecha_fin, $profesor_id);
    }

    if ($result) {
        echo "<div class='alert alert-success'>El $tipo ha sido agregado exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Hubo un error al agregar el $tipo.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Cursos, Talleres y Acompañamientos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
       * {
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: #333;
            height: 100vh;
            padding-top: 20px;
        }

        .sidebar h4 {
            color: white;
            font-family: 'Bungee Spice', sans-serif;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            transition: transform 0.3s ease, background-color 0.3s ease;
            text-align: center;
        }

        .sidebar a:hover {
            transform: translateY(3px);
            background-color: #555;
        }

        .main-content {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group select, .form-group input, .form-group textarea {
            width: 100%;
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <h4 class="text-center">Admin Panel</h4>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="admin_users.php">Usuarios</a></li>
                    <li><a href="viewCertificate.php">Certificados</a></li>
                    <li><a href="../../../config/webAppSettings/index.php">Configuración</a></li>
                    <li><a href="course_administration.php" class="active">Administrar Cursos</a></li>
                    <li><a href="personnel_administration.php">Administrar Personal</a></li>
                    <li><a href="../../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h2>Administrar Cursos, Talleres y Acompañamientos</h2>

                <form method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de Fin:</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="profesor_id">Profesor:</label>
                        <select name="profesor_id" id="profesor_id" class="form-control" required>
                            <option value="">Seleccione un profesor</option>
                            <?php foreach ($profesores as $profesor): ?>
                                <option value="<?php echo htmlspecialchars($profesor['id']); ?>">
                                    <?php echo htmlspecialchars($profesor['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo" class="form-control" required>
                            <option value="curso">Curso</option>
                            <option value="taller">Taller</option>
                            <option value="acompanamiento">Acompañamiento</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>

                <hr>

                <h3>Lista de Cursos, Talleres y Acompañamientos</h3>
                <select class="form-control">
                    <option value="">Seleccione una opción</option>
                    <optgroup label="Cursos">
                        <?php if (!empty($cursos)): ?>
                            <?php foreach ($cursos as $curso): ?>
                                <option value="<?php echo htmlspecialchars($curso['id']); ?>">
                                    <?php echo htmlspecialchars($curso['titulo']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option>No hay cursos disponibles</option>
                        <?php endif; ?>
                    </optgroup>
                    <optgroup label="Talleres">
                        <?php if (!empty($talleres)): ?>
                            <?php foreach ($talleres as $taller): ?>
                                <option value="<?php echo htmlspecialchars($taller['id']); ?>">
                                    <?php echo htmlspecialchars($taller['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option>No hay talleres disponibles</option>
                        <?php endif; ?>
                    </optgroup>
                    <optgroup label="Acompañamientos">
                        <?php if (!empty($acompanamientos)): ?>
                            <?php foreach ($acompanamientos as $acompanamiento): ?>
                                <option value="<?php echo htmlspecialchars($acompanamiento['id']); ?>">
                                    <?php echo htmlspecialchars($acompanamiento['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option>No hay acompañamientos disponibles</option>
                        <?php endif; ?>
                    </optgroup>
                </select>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
