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

// Obtener todos los certificados
$certificados = $usuariosController->obtenerCertificados();

if ($certificados === false) {
    die('Error al recuperar los certificados.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificados</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
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
                    <li><a href="../../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
            
            <!-- Main content -->
            <div class="col-md-10 main-content">
                <h2>Certificados</h2>

                <!-- DataTable -->
                <table id="certificadosTable" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Usuario</th>
                            <th>Curso</th>
                            <th>Fecha de Creación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($certificados as $certificado): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($certificado['id']); ?></td>
                                <td><?php echo htmlspecialchars($certificado['nombre_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($certificado['curso']); ?></td>
                                <td><?php echo htmlspecialchars($certificado['fecha_creacion']); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($certificado['archivo_certificado']); ?>" class="btn btn-primary btn-sm" download>Descargar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#certificadosTable').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>
</body>
</html>