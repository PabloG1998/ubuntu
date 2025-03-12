<?php
include './db.php';
include '../../resources/controllers/SettingsController.php';

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$dbConnection = $database->getConnection();

if ($dbConnection === null) {
    die('Error: No se pudo establecer una conexión con la base de datos.');
}

// Crear una instancia del controlador de configuración
$configuracionController = new SettingsController($dbConnection);

// Obtener las configuraciones actuales
$configuracion = $configuracionController->obtenerConfiguracion();

// Verificar que la configuración se obtuvo correctamente
if ($configuracion === false) {
    die('Error: No se pudieron obtener las configuraciones.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
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
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <h4 class="text-center">Admin Panel</h4>
                <ul>
                    <li><a href="../../users/content/admin/dashboardAdmin.php">Inicio</a></li>
                    <li><a href="../../users/content/admin/admin_users.php">Usuarios</a></li>
                    <li><a href="configuracion.php" class="active">Configuración</a></li>
                    <li><a href="../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
            
            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h2>Configuración</h2>

                <!-- Formulario de Configuración -->
                <form action="saveChanges.php" method="post">
                    <div class="form-group">
                        <label for="email">Correo Electrónico del Administrador</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($configuracion['email']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="smtp_server">Servidor SMTP</label>
                        <input type="text" class="form-control" id="smtp_server" name="smtp_server" value="<?php echo htmlspecialchars($configuracion['smtp_server']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="smtp_port">Puerto SMTP</label>
                        <input type="number" class="form-control" id="smtp_port" name="smtp_port" value="<?php echo htmlspecialchars($configuracion['smtp_port']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="timezone">Zona Horaria</label>
                        <select class="form-control" id="timezone" name="timezone" required>
                            <option value="America/Argentina/Buenos_Aires" <?php echo $configuracion['timezone'] == 'America/Argentina/Buenos_Aires' ? 'selected' : ''; ?>>Buenos Aires</option>
                            <option value="America/New_York" <?php echo $configuracion['timezone'] == 'America/New_York' ? 'selected' : ''; ?>>Nueva York</option>
                            <option value="Europe/London" <?php echo $configuracion['timezone'] == 'Europe/London' ? 'selected' : ''; ?>>Londres</option>
                            <!-- Agrega más opciones de zona horaria según tus necesidades -->
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>