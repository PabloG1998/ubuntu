<?php 



//localhost
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ubuntud";

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
  
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?home=rightClickEvent=True&homeLoadaded=true%showWelcome">Bienvenido</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../../../../educational/courses">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../../educational/workshops">Talleres</a>
        </li>
        <li class="nav-item">
      <!--    <a class="nav-link" href="../../../../institutional/accompaniment">Acompañamientos</a> -->
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
       
       <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
-->
          </ul>

        </li>
      </ul>
    </div>
  </div>
</nav>
    <!-- Search -->
  <!--  <input class="search" type="search" placeholder="Buscar..." id="search" >
    <button class="btn btn-success">Buscar</button> -->
  </ul>
  
 
</nav>

<br> <br>

    <!--Detalle Card-->
    <div class="card">
  <div class="card-header">
    ¿Qué hace un Acompañante Terapéutico?
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>
      Un <b>acompañante terapeutico</b> Un acompañante terapéutico es un profesional que brinda apoyo emocional, 
      social y práctico a personas con dificultades psíquicas, emocionales o físicas. Su función principal es asistir en 
      actividades cotidianas, acompañar en tratamientos terapéuticos y ofrecer contención en situaciones de crisis, 
      siempre con un enfoque personalizado.
      No realiza diagnósticos ni tratamientos médicos,
       pero trabaja en conjunto con otros profesionales de la salud. Además, 
       ayuda a fomentar la autonomía del paciente, reforzando sus habilidades sociales y apoyando su 
       integración en la vida diaria.
      El acompañante terapéutico puede 
      ser útil en casos de trastornos mentales, discapacidades, rehabilitación, 
      entre otros, y se caracteriza por su empatía, paciencia, y capacidad de escucha activa.


      </p>
     <!-- <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer> -->
    </blockquote>
  </div>
</div>

    <!-- Formulario de Inscripción -->
    <div class="container mt-5">
        <h2>Formulario de Inscripción a Acompañante Terapeutico</h2>
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
            <input type="text" class="form-control" id="course" name="course" value="Diplomatura Asistente Terapeutico" readonly>
        </div>
        <button type="button" id="inscribirseBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comprobanteModal">Inscribirse</button>
        </form>
    </div>
    <h3 class="text-center"> Se le enviara un WhatsApp dentro de las 24 horas con los datos del pago!</h3>

    <!--Modal para subir comprobante-->
    <div class="modal fade" id="comprobanteModal" tabindex="-1" aria-labelledby="comprobanteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="comprobanteModalLabel">Datos Bancarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <hr>
                    <h5>Inscripcion: $5.000</h5>
                    <h5>Cuota Mensual: $35.000</h5>
                    <hr>
                    <h6>Por favor, realiza tu pago a la siguiente cuenta:</h6>
                    <p>Banco: Banco Provincia</p>
                    <p>Titular: Martin Nace</p>
                    <p>CBU: 0140060103500357748020</p>
                    <p>Luego sube tu comprobante de pago:</p>

                    <form id="uploadForm" action="index.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="firstName" value="" id="modalFirstName">
                        <input type="hidden" name="lastName" value="" id="modalLastName">
                        <input type="hidden" name="email" value="" id="modalEmail">
                        <input type="hidden" name="phone" value="" id="modalPhone">
                        <input type="hidden" name="course" value="Curso de Asistente Terapeutico">
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
                        <li><a href="#" class="text-white">Correo: centrodecapacitacion.ubuntu@gmail.com </a></li>
                        <li><a href="#" class="text-white">+54 9 1165300745 (Celular) - 45545310 (línea fija)</a></li>
                        <li><a href="#" class="text-white">Dirección: Escultor Santiago Parodi 4330 - Caseros, Tres de Febrero. Pcia. Buenos Aires</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; 2024 Nombre de la Empresa. Todos los derechos reservados.
        </div>
    </footer>

   

</body>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

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
</html>
