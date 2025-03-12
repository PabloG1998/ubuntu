<?php 
// Aquí podrías incluir la conexión a la base de datos si es necesario en otras partes
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Curriculums</title>
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
                    <li><a href="../admin/dashboardAdmin.php">Inicio</a></li>
                    <li><a href="admin_users.php" class="active">Usuarios</a></li>
                    <li><a href="viewCertificate.php">Certificados</a></li>
                    <li><a href="../../../config/webAppSettings/index.php">Configuración</a></li>
                    <li><a href="course_administration.php">Administración</a></li>
                    <li><a href="viewCV.php">Ver Postulaciones</a></li>
                    <li><a href="viewInscriptions.php">Ver Inscripciones</a></li>
                    <li><a href="../../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>

            <main class="col-md-10 main-content">
                <div class="container mt-5">
                    <h2 class="text-center">Lista de Curriculums</h2>
                    <table id="curriculumTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Archivo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Conexión a la base de datos
                            $servername = "localhost";
                            $username = "u810780627_ubuntudb";
                            $password = "Ubuntu2020sql";
                            $dbname = "u810780627_ubuntudb";

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Obtener currículums de la base de datos
                            $sql = "SELECT * FROM cvs";
                            $result = $conn->query($sql);

                            $fileBasePath = '../../../../platform/jobs/'; // Ruta base a los archivos

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['name']}</td>
                                            <td><a href='{$fileBasePath}{$row['file_path']}' target='_blank'>{$row['file_path']}</a></td>
                                            <td><a href='{$fileBasePath}{$row['file_path']}' download class='btn btn-success btn-sm'>Descargar</a></td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center'>No hay currículums disponibles.</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Incluir jQuery y DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#curriculumTable').DataTable(); // Inicializar DataTable
        });
    </script>

</body>
</html>
