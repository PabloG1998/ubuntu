<?php
//Hostinger

$servername = "localhost";
$username = "u810780627_ubuntudb";
$password = "Ubuntu2020sql";
$dbname = "u810780627_ubuntudb";
/*
//localhost

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ubuntudb";
*/
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

    // Preparar la consulta SQL para la inscripción y ejecutar
    $sql = "INSERT INTO formulario_inscripcion (nombre_completo, apellido, email, telefono, curso) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("sssss", $nombre_completo, $apellido, $email, $telefono, $curso);

    if ($stmt->execute()) {
        // Guardar el ID de la inscripción para usarlo al subir el comprobante
        $inscripcion_id = $stmt->insert_id; // Obtener el ID de la última inserción
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cierra la conexión
    $stmt->close();

    // Manejo de subida de comprobante
    if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] == UPLOAD_ERR_OK) {
        $comprobante = $_FILES['comprobante']['tmp_name'];
        $comprobante_name = $_FILES['comprobante']['name'];
        $comprobante_blob = file_get_contents($comprobante); // Leer el archivo

        // Preparar la consulta para subir el comprobante
        $sql = "INSERT INTO comprobantes (id, nombre_completo, comprobante, fecha_de_creacion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        $stmt->bind_param("issb", $inscripcion_id, $nombre_completo, $apellido, $comprobante_blob);

        if ($stmt->execute()) {
            echo "Comprobante subido con éxito";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../../../../index.php?home=rightClickEvent=True&homeLoadaded=true%showWelcome">Bienvenido</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../../../courses/">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../../educational/workshops">Talleres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../../institutional/accompaniment">Acompañamientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../../institutional/consultancy">Consultoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../../platform/register.php">Crear Cuenta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../../platform/login.php">Ingresar</a>
        </li>
</nav>
    <br><br>

    <!--Detalle Card-->
    <div class="card">
        <div class="card-header">
            ¿Qué es la Terapia Floral 
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>
                La <b>Terapia Floral</b> es una práctica alternativa que utiliza esencias de flores para tratar diversos desequilibrios 
                emocionales y psicológicos. Fue desarrollada por el médico inglés Edward Bach en la década de 1930 y 
                se basa en la idea de que las flores tienen propiedad energéticas que pueden 
                influir en las emociones y el bienestar mental de una persona
                </p>
            </blockquote>
        </div>
    </div>

    <!-- Formulario de Inscripción -->
    <div class="container mt-5">
        <h2>Formulario de Inscripción a Terapia Floral</h2>
        <h3><b>Abonando el curso completo, obtiene un 15% de descuento</b></h3>
        <!--Aviso-->
        
        <div class="alert alert-danger" role="alert">Los precios sufrirán aumentos cada tres meses según el IPC-Trimestral</div>
        <div class="alert alert-success" role="alert">Todos los cursos cuentan con salida laboral y certificación Nacional </div>

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
                <input type="text" class="form-control" id="course" name="course" value="Curso de Terapia Floral">
            <button type="button" id="inscribirseBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comprobanteModal">Inscribirse</button>
        </form>
    </div>

    <!-- Modal para subir comprobante -->
    <div class="modal fade" id="comprobanteModal" tabindex="-1" aria-labelledby="comprobanteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="comprobanteModalLabel">Datos Bancarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                                     
                    <h5>Inscripción: $5.000</h5>
                    <h5>Cuota Mensual: $25.000</h5>
                    <hr>
                    <h6>Por favor, realiza tu pago a la siguiente cuenta:</h6>
                    <p>Banco: Banco Provincia</p>
                    <p>Titular: Martin Nace</p>
                    <p>CBU: 0140060103500357748020</p>
                    <p>Luego sube tu comprobante de pago:</p>
                    <hr>
                    <h3><b>Salida Laboral - Alcance Nacional</b></h3>
                    <form id="uploadForm" action="index.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="firstName" value="" id="modalFirstName">
                        <input type="hidden" name="lastName" value="" id="modalLastName">
                        <input type="hidden" name="email" value="" id="modalEmail">
                        <input type="hidden" name="phone" value="" id="modalPhone">
                        <input type="hidden" name="course" value="Curso de Terapia Floral">
                        <div class="mb-3">
                            <input type="file" class="form-control" id="comprobante" name="comprobante" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Comprobante</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    
    <script>
        // Al abrir el modal, copiar datos del formulario a los campos ocultos
    document.querySelector('#inscribirseBtn').addEventListener('click', function () {
        // Obtener los valores de los campos
        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
      if (firstName && lastName && email && phone == null) {
          alert("null");
         
      }
        // Verificar si todos los campos tienen contenido
        if (firstName && lastName && email && phone) {
            // Llenar los campos ocultos del modal
            document.getElementById('modalFirstName').value = firstName;
            document.getElementById('modalLastName').value = lastName;
            document.getElementById('modalEmail').value = email;
            document.getElementById('modalPhone').value = phone;

            // Mostrar el modal
            const modal = new bootstrap.Modal(document.getElementById('comprobanteModal'));
            modal.show();
        } else {
            // Mostrar alerta si faltan campos por llenar
            alert('Complete los campos antes de continuar.');
            location.reload();
        }
    });
</script>
</body>
</html>
