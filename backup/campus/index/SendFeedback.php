<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../platform/login.php"); // Redirigir al usuario no autenticado
    exit();
}

// Verificar si el usuario es alumno
if ($_SESSION['role'] != 'alumn') {
    header("Location: ../platform/login.php"); // Redirigir si no es alumno
    exit();
}
?>

<?php 
     

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $comentario = $_POST['comentario'];
    
        //conexion
        $conn = new mysqli("localhost", "root", "", "ubuntudb");
    
        //verificar
        if($conn->connect_error) {
            die("Conexion fallida: " . $conn->connect_error);
        }
    
        //Preparar y ejecutar la ins
        $stmt = $conn->prepare("insert into comentarios (nombre, comentario) values (?, ?)");
        $stmt->bind_param("ss", $nombre, $comentario);
    
        if ($stmt->execute()) {
            echo "Comentario guardado correctamente";
        }else{
            echo "Error al guardar el comentario: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Campus Virtual</title>
    <style>
        .gradient-custom {
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            padding-left: 10px;
            color: #ffffff;
        }
        .sidebar h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 30px;
        }
        .sidebar a {
            color: #ffffff;
            padding: 15px;
            text-decoration: none;
            display: block;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .feedback-form {
            background: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .feedback-form label {
            display: block;
            margin-bottom: 10px;
        }
        .feedback-form input[type="text"],
        .feedback-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .feedback-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .feedback-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .comments-section {
            margin-top: 20px;
        }
        .comment {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="gradient-custom">
    <div class="sidebar">
        <h2>Campus Virtual</h2>
        <a href="index.php#materiales">Materiales</a>
        <a href="index.php#clases-grabadas">Clases Grabadas</a>
        <a href="index.php#examenes">Exámenes</a>
        <a href="SendFeedback.php">¡Envíanos tus comentarios!</a>
        <a href="../../config/logout.php">Cerrar Sesión</a>
    </div>

    <div class="content">
       
        <div class="feedback-form">
            <h3>Envíanos tus comentarios</h3>
            <form action="SendFeedback.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="comentario">Comentario:</label>
                <textarea name="comentario" id="comentario" rows="4" required></textarea>

                <input type="submit" value="Enviar Comentario">
            </form>
        </div>

        <div class="comments-section">
            <h3>Comentarios recientes:</h3>
            <?php 
        $conn = new mysqli("localhost", "root", "", "ubuntudb");

        //verificar
        if($conn->connect_error) {
            die("Connection Failed" . $conn->connect_error);
        }

        //Consulta de comentarios
        $sql = "select nombre, comentario, fecha from comentarios order by fecha desc";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<p><strong>". htmlspecialchars($row['nombre']) . "</strong> (" .$row['fecha'] . ")</p>";
                echo "<p>" . htmlspecialchars($row['comentario']) . "</p><hr>";
            }
        }else{
            echo "<p> No hay comentarios aun</p>";

        }
        $conn->close();
    ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

