<?php
include '../../../resources/controllers/UsuariosController.php';
include '../../../config/db.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$dbConnection = $database->getConnection();

if ($dbConnection === null) {
    die('Error: No se pudo establecer una conexión con la base de datos.');
}

// Crear una instancia del controlador de usuarios con la conexión a la base de datos
$usuariosController = new UsuariosController($dbConnection);

// Obtener todos los usuarios
$usuarios = $usuariosController->obtenerTodosLosUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
           
            <nav class="col-md-2 sidebar">
                <h4 class="text-center">Admin Panel</h4>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="admin_users.php" class="active">Usuarios</a></li>
                    <li><a href="viewCertificate.php">Certificados</a></li>
                    <li><a href="../../../config/webAppSettings/index.php">Configuración</a></li>
                    <li><a href="course_administration.php">Administración</a></li>
                    <li><a href="viewCV.php">Ver Postulaciones</a></li>
                    <li><a href="viewInscriptions.php">Ver inscripciones</a></li>
                    <li><a href="adminNews.php">Añadir/Quitar Noticias</a></li>
                    <li><a href="viewMessages.php">Ver Mails</a></li>
                    <li><a href="../../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>



<!--TEST-->

</head>
<body>


            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h2>Lista de Usuarios</h2>

                <?php if ($usuarios): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['role']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No se encontraron usuarios.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>