<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'alumn') {
    header("Location: ../platform/login.php");
    exit();
}

// Conexión a la base de datos
$host = 'localhost';
$db = 'ubuntudb';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el email del usuario en sesión
$email = $_SESSION['email'];

// Obtener el ID del usuario
$query_user_id = "SELECT id FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($query_user_id);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user ? $user['id'] : null;
$stmt->close();

if ($user_id === null) {
    die("No se encontró el usuario.");
}

// Obtener las clases grabadas del usuario
$query_clases = "
SELECT cg.titulo, cg.descripcion, cg.youtube_url
FROM clases_grabadas cg
JOIN cursos c ON cg.curso_id = c.id_curso
JOIN inscripciones i ON c.id_curso = i.id_curso
WHERE i.id_alumno = ?";
$stmt = $conn->prepare($query_clases);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$clases_grabadas = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clases_grabadas[] = $row;
    }
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="shortcut icon" href="../../resources/images/EagSKyL6nmIT5erqWDgzbASr0mrytrYTcFlevFtMJegeA8qwxTpQPhGOr3gchU.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Clases Grabadas</title>
    <style>
        .content-container {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboardAlumno.php">Campus Virtual</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="materiales.php">Materiales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clases.php">Clases Grabadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="examenes.php">Exámenes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../platform/logout.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-container">
        <h2>Clases Grabadas</h2>
        <p>Aquí puedes ver las grabaciones de las clases. Puedes acceder a las grabaciones desde los enlaces proporcionados a continuación.</p>

        <?php if (count($clases_grabadas) > 0): ?>
            <?php foreach ($clases_grabadas as $clase): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($clase['titulo']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($clase['descripcion']); ?></p>
                        <a href="<?php echo htmlspecialchars($clase['youtube_url']); ?>" class="btn btn-primary" target="_blank">Ver Clase</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay clases grabadas disponibles.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
