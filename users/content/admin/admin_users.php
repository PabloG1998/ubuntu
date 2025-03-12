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

if ($usuarios === false) {
    die('Error al recuperar los usuarios.');
}

// Manejar la actualización del estado del usuario
if (isset($_POST['update_status'])) {
    $usuarioId = $_POST['id'];
    $estado = $_POST['estado'] === 'Activo' ? 1 : 0;
    $usuariosController->actualizarEstadoUsuario($usuarioId, $estado);
    // Redirige para evitar el envío múltiple del formulario
    header("Location: admin_users.php");
    exit;
}
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
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <h4 class="text-center">Admin Panel</h4>
                <ul>
                    <li><a href="./dashboardAdmin.php">Inicio</a></li>
                    <li><a href="admin_users.php" class="active">Usuarios</a></li>
                    <li><a href="../../content/admin/viewCertificate.php">Certificados</a></li>
                    <li><a href="../../../config/webAppSettings/index.php">Configuración</a></li>
                    <li><a href="admin_users.php">Administracion</a></li>
                    <li><a href="viewCV.php">Ver Postulaciones</a></li>
                    <li><a href="viewInscriptions.php">Ver Inscripciones</a></li>
                    <li><a href="viewMessages.php">Ver Mails</a></li>
                    <li><a href="adminNews.php">Añadir/Quitar Noticias</a></li>
                    <li><a href="../../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
            
            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h2>Lista de Usuarios</h2>

                <!-- Verificar si hay usuarios disponibles -->
                <?php if ($usuarios && is_array($usuarios)): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['role']); ?></td>
                                    <td><?php echo $usuario['activo'] ? 'Activo' : 'Inactivo'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No se encontraron usuarios.</p>
                <?php endif; ?>

                <!-- Formulario para actualizar el estado del usuario -->
                <h3>Actualizar Estado del Usuario</h3>
                <form action="admin_users.php" method="POST">
                    <div class="form-group">
                        <label for="id">ID del Usuario</label>
                        <select id="id" name="id" class="form-control" required>
                            <option value="">Seleccionar usuario</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?php echo htmlspecialchars($usuario['id']); ?>">
                                    <?php echo htmlspecialchars($usuario['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado" class="form-control" required>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <button type="submit" name="update_status" class="btn btn-primary">Actualizar Estado</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>