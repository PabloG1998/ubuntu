<?php
include '../../../config/webAppSettings/ConfiguracionController.php';
include '../../../config/db.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$dbConnection = $database->getConnection();

if ($dbConnection === null) {
    die('Error: No se pudo establecer una conexión con la base de datos.');
}

// Crear una instancia del controlador de personal
$personalController = new ConfiguracionController($dbConnection);

// Obtener todos los registros de personal
$personal = $personalController->obtenerTodoElPersonal();

// Procesar el formulario de agregar, modificar o eliminar personal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agregar_personal'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $mail = $_POST['mail'];
        $telefono = $_POST['telefono'];
        $cargo = $_POST['cargo'];

        $result = $personalController->agregarPersonal($nombre, $apellido, $mail, $telefono, $cargo);
        if ($result) {
            echo "<div class='alert alert-success'>Personal agregado exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al agregar personal.</div>";
        }
    }

    if (isset($_POST['modificar_personal'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $mail = $_POST['mail'];
        $telefono = $_POST['telefono'];
        $cargo = $_POST['cargo'];

        $result = $personalController->modificarPersonal($id, $nombre, $apellido, $mail, $telefono, $cargo);
        if ($result) {
            echo "<div class='alert alert-success'>Personal modificado exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al modificar personal.</div>";
        }
    }

    if (isset($_POST['eliminar_personal'])) {
        $id = $_POST['id'];

        $result = $personalController->eliminarPersonal($id);
        if ($result) {
            echo "<div class='alert alert-success'>Personal eliminado exitosamente.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar personal.</div>";
        }
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
                    <li><a href="adminNews.php">Añadir/Quitar Noticias</a></li>
                    <li><a href="viewMessages.php">Ver Mails</a></li>
                    <li><a href="../../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <div class="container">
                    <h2>Administrar Personal</h2>

                    <!-- Formulario para agregar personal -->
                    <form id="agregarPersonalForm" method="POST">
                        <h3>Agregar Personal</h3>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mail">Email:</label>
                            <input type="email" name="mail" id="mail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo:</label>
                            <input type="text" name="cargo" id="cargo" class="form-control" required>
                        </div>
                        <button type="submit" name="agregar_personal" class="btn btn-success">Agregar</button>
                    </form>

                    <hr>

                    <!-- Formulario para modificar personal -->
                    <form id="modificarPersonalForm" method="POST">
                        <h3>Modificar Personal</h3>
                        <div class="form-group">
                            <label for="id">ID del Personal:</label>
                            <select name="id" id="id" class="form-control" required>
                                <option value="">Seleccione una persona</option>
                                <?php foreach ($personal as $persona): ?>
                                    <option value="<?php echo htmlspecialchars($persona['id']); ?>">
                                        <?php echo htmlspecialchars($persona['nombre'] . " " . $persona['apellido'] . " - " . $persona['cargo']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido:</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mail">Email:</label>
                            <input type="email" name="mail" id="mail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cargo">Cargo:</label>
                            <input type="text" name="cargo" id="cargo" class="form-control" required>
                        </div>
                        <button type="submit" name="modificar_personal" class="btn btn-primary">Modificar</button>
                    </form>

                    <hr>

                    <!-- Formulario para eliminar personal -->
                    <form id="eliminarPersonalForm" method="POST">
                        <h3>Eliminar Personal</h3>
                        <div class="form-group">
                            <label for="id">ID del Personal:</label>
                            <select name="id" id="id" class="form-control" required>
                                <option value="">Seleccione una persona</option>
                                <?php foreach ($personal as $persona): ?>
                                    <option value="<?php echo htmlspecialchars($persona['id']); ?>">
                                        <?php echo htmlspecialchars($persona['nombre'] . " " . $persona['apellido'] . " - " . $persona['cargo']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="eliminar_personal" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>

                <!-- Scripts -->
                <script>
                    // Validar que los campos estén llenos antes de enviar el formulario
                    function validarFormulario(form) {
                        var inputs = form.querySelectorAll('input, select');
                        for (var i = 0; i < inputs.length; i++) {
                            if (inputs[i].value === '') {
                                alert('Por favor complete todos los campos antes de enviar.');
                                return false;
                            }
                        }
                        return true;
                    }

                    // Evento de submit para el formulario de agregar personal
                    document.getElementById('agregarPersonalForm').addEventListener('submit', function(event) {
                        if (!validarFormulario(this)) {
                            event.preventDefault();
                        }
                    });

                    // Evento de submit para el formulario de modificar personal
                    document.getElementById('modificarPersonalForm').addEventListener('submit', function(event) {
                        if (!validarFormulario(this)) {
                            event.preventDefault();
                        }
                    });

                    // Evento de submit para el formulario de eliminar personal
                    document.getElementById('eliminarPersonalForm').addEventListener('submit', function(event) {
                        if (!validarFormulario(this)) {
                            event.preventDefault();
                        }
                    });
                </script>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </div>
        </div>
    </div>
</body>
</html>
