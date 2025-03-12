<?php 
$host = 'localhost';
$dbname = 'u810780627_ubuntudb';
$user = 'u810780627_ubuntudb';
$password = '';

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica que los datos se han enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_completo = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $apellido = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telefono = isset($_POST['phone']) ? $_POST['phone'] : '';
    $curso = isset($_POST['course']) ? $_POST['course'] : '';

    // Preparar la consulta SQL y ejecutar
    $sql = "INSERT INTO formulario_inscripcion (nombre_completo, apellido, email, telefono, curso) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("sssss", $nombre_completo, $apellido, $email, $telefono, $curso);

    if ($stmt->execute()) {
     //   echo "Inscripción realizada con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cierra la conexión
    $stmt->close();
} else {
 //   echo "No se enviaron datos por POST.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../resources/css/style.css">
    <link rel="shortcut icon" href="resources/images/EagSKyL6nmIT5erqWDgzbASr0mrytrYTcFlevFtMJegeA8qwxTpQPhGOr3gchU.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio | Ubuntu</title>
</head>

<body>
    <!-- Menu -->
    <nav class="menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="educational/courses/">Cursos</a></li>
            <li><a href="educational/workshops/">Talleres</a></li>
            <li><a href="institutional/accomaniment/">Acompañamientos</a></li>
            <li><a href="institutional/consultancy/">Consultoría</a></li>
            <li><a href="platform/register.php">Crear Cuenta</a></li>
            <li><a href="platform/login.php">Ingresar</a></li>
        </ul>
    </nav>

    <br><br>

    <!--Detalle Card-->
    <div class="card">
  <div class="card-header">
    ¿Qué es el Árbol Genealógico?
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>
        Un <b>Árbol Genealógico</b> 
       es una representación gráfica que muestra las relaciones familiares a lo largo de varias generaciones.
       Es una herramienta útil para visualizar cómo se conectan los miembros de una familia, facilitando la comprensión
       de las conexiones entre parientes cercanos y lejanos
      </p>
     <!-- <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer> -->
    </blockquote>
  </div>
</div>

    <!-- Formulario de Inscripción -->
    <div class="container mt-5">
        <h2>Formulario de Inscripción a Árbol Genealógico</h2>
        <form id="RegistrationForm" action="index.php" method="post">
            <div class="mb-3">
                <label for="firstName" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
            <label for="course" class="form-label">Curso</label>
            <input type="text" class="form-control" id="course" name="course" value="Curso de Genealogía" readonly>
        </div>
            <button type="submit" class="btn btn-primary">Inscribirse</button>
        </form>
    </div>
    <h3 class="text-center"> Se le enviara un WhatsApp dentro de las 24 horas con los datos del pago!</h3>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sobre nosotros</h5>
                    <p>Información sobre la empresa, su misión, visión y valores.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Enlaces útiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="./helpful-links/scopes/" class="text-white">Alcances</a></li>
                        <li><a href="./helpful-links/pricing/" class="text-white">Precios</a></li>
                        <li><a href="./jobs" class="text-white">Trabaja con nosotros</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Correo: info@empresa.com</a></li>
                        <li><a href="#" class="text-white">Teléfono: +123 456 7890</a></li>
                        <li><a href="#" class="text-white">Dirección: Calle Falsa 123</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; 2024 Nombre de la Empresa. Todos los derechos reservados.
        </div>
    </footer>

   

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</html>
