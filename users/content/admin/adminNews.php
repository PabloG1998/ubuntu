<?php 

// Conexión a la base de datos
//Hostinger

$servername = 'localhost';
$dbname = 'u810780627_ubuntudb';
$username = 'u810780627_ubuntudb';
$password = 'Ubuntu2020sql';

/*
// Conexión a la base de datos local
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "ubuntudb";
*/
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar envíos de formularios (Agregar / Editar)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        // Recoger los datos del formulario
        $titular    = isset($_POST['titular']) ? $conn->real_escape_string($_POST['titular']) : "";
        $contenido = isset($_POST['contenido']) ? $conn->real_escape_string($_POST['contenido']) : "";
        
        if ($_POST['action'] == 'add') {
            // Agregar nueva noticia
            $sql = "INSERT INTO noticias (titular, contenido) VALUES ('$titular', '$contenido')";
            $conn->query($sql);
        } elseif ($_POST['action'] == 'edit' && isset($_POST['id'])) {
            // Actualizar noticia existente
            $id  = (int) $_POST['id'];
            $sql = "UPDATE noticias SET titular='$titular', contenido='$contenido' WHERE id=$id";
            $conn->query($sql);
        }
    }
    // Redirigir para evitar reenvío del formulario
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Procesar eliminación
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $sql = "DELETE FROM noticias WHERE id=$id";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Verificar si se solicita editar (mostrar el formulario de edición)
$isEditing = false;
$editNews  = null;
if (isset($_GET['edit'])) {
    $isEditing = true;
    $id        = (int) $_GET['edit'];
    $sql       = "SELECT * FROM noticias WHERE id=$id";
    $result    = $conn->query($sql);
    if ($result->num_rows > 0) {
        $editNews = $result->fetch_assoc();
    }
}

// Obtener todas las noticias para la lista
$sql    = "SELECT * FROM noticias";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Noticias</title>
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
        .sidebar a:hover, .sidebar a.active {
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
                    <li><a href="../admin/dashboardAdmin.php">Inicio</a></li>
                    <li><a href="admin_users.php">Usuarios</a></li>
                    <li><a href="viewCertificate.php">Certificados</a></li>
                    <li><a href="../../../config/webAppSettings/index.php">Configuración</a></li>
                    <li><a href="course_administration.php">Administración</a></li>
                    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="active">Añadir/Quitar Noticias</a></li>
                    <li><a href="viewCV.php">Ver Postulaciones</a></li>
                    <li><a href="../../../config/logout.php">Cerrar Sesión</a></li>
                </ul>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-10 main-content">
                <div class="container mt-4">
                    <h2 class="text-center">
                        <?php echo $isEditing ? "Editar Noticia" : "Agregar Noticia"; ?>
                    </h2>
                    <!-- Formulario para agregar/editar noticia -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="mb-5">
                        <?php if ($isEditing && isset($editNews)): ?>
                            <input type="hidden" name="id" value="<?php echo $editNews['id']; ?>">
                        <?php endif; ?>
                        <input type="hidden" name="action" value="<?php echo $isEditing ? 'edit' : 'add'; ?>">
                        <div class="form-group">
                            <label for="titular">Título</label>
                            <input type="text" name="titular" id="titular" class="form-control" required value="<?php echo $isEditing ? htmlspecialchars($editNews['titular']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="contenido">Contenido</label>
                            <textarea name="contenido" id="contenido" class="form-control" rows="5" required><?php echo $isEditing ? htmlspecialchars($editNews['contenido']) : ''; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-<?php echo $isEditing ? 'warning' : 'primary'; ?>">
                            <?php echo $isEditing ? 'Actualizar Noticia' : 'Agregar Noticia'; ?>
                        </button>
                        <?php if ($isEditing): ?>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Cancelar</a>
                        <?php endif; ?>
                    </form>

                    <h2 class="text-center">Listado de Noticias</h2>
                    <table id="newsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Contenido</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                // Mostrar las noticias
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>" . htmlspecialchars($row['titular']) . "</td>
                                            <td>" . htmlspecialchars($row['contenido']) . "</td>
                                            <td>
                                                <a href='?edit={$row['id']}' class='btn btn-sm btn-warning'>Editar</a>
                                                <a href='?delete={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Está seguro de eliminar esta noticia?\");'>Eliminar</a>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No hay noticias disponibles.</td></tr>";
                            }
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
            $('#newsTable').DataTable(); // Inicializar DataTable
        });
    </script>
</body>
</html>
<?php
$conn->close();
?>
