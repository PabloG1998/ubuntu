<?php 

//Hostinger

$servername = "localhost";
$username = "u810780627_ubuntudb";
$password = "Ubuntu2020sql";
$dbname = "u810780627_ubuntudb";


//localhost 
/*
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
          <a class="nav-link" href="../../../../educactional/accomaniment">Acompañamientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../../educactional/consultancy">Consultoria</a>
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
    Taller de Arbol Genealogico (Genealogia)
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>
        Componentes del  <b>Árbol Genealogico</b> <br>
        <b>1: Raíces</b> <br>
        <b>2: Nodos</b> <br>
        <b>3: Lineas de Conexión</b> <br>
        <b>4: Generaciones</b> <br>
        <b>5: Datos Personales</b>
      </p>
     <!-- <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer> -->
    </blockquote>
  </div>
</div>

    <!-- Formulario de Inscripción -->
    <div class="container mt-5">
        <h2>Formulario de Inscripción a Taller de Arbol Genealogico (Genealogia)</h2>
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
            <label for="course" class="form-label">Taller</label>
            <input type="text" class="form-control" id="course" name="course" value="Taller de Genealogia" readonly>
        </div>
        <button type="button" id="inscribirseBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comprobanteModal">Inscribirse</button>
        </form>
    </div>
   <!-- <h3 class="text-center"> Se le enviara un WhatsApp dentro de las 24 horas con los datos del pago!</h3> -->

    <!-- Modal para subir comprobante -->
    <div class="modal fade" id="comprobanteModal" tabindex="-1" aria-labelledby="comprobanteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="comprobanteModalLabel">Datos Bancarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Por favor, realiza tu pago a la siguiente cuenta:</h6>
                    <p>Banco: Banco Provincia</p>
                    <p>Nombre: Martín Nace</p>
                    <p></p>
                    <p>CBU: 0140060103500357748020</p>
                    <p>Luego sube tu comprobante de pago:</p>
                    <form id="uploadForm" action="index.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="firstName" value="" id="modalFirstName">
                        <input type="hidden" name="lastName" value="" id="modalLastName">
                        <input type="hidden" name="email" value="" id="modalEmail">
                        <input type="hidden" name="phone" value="" id="modalPhone">
                        <input type="hidden" name="course" value="Taller de Genealogia">
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
                        <li><a href="../../../../platform/jobs/" class="text-white">Trabaja con nosotros</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Correo: centrodecapacitacion.ubuntu@gmail.com </a></li>
                        <li><a href="#" class="text-white">Teléfono: 1165300745 - 45545310</a></li>
                        <li><a href="#" class="text-white">Dirección: Santiago Parodi 4330 - Caseros, 3 de Febrero. Pcia. Buenos Aires</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <img src="../../../../resources/images/LOGO COMISION EN BLANCO.png" alt="Logo comision" height="150" width="150">
          <img src="../../../../resources/images/Grupo educativo LOGO BLANCO.png" alt="Logo grupo eduactivo" height="150" width="150">
          <img src="../../../../resources/images/logo-nuevo.png" alt="logo centro" height="150" width="150">
         <h6> &copy; 2024 CENTRO DE CAPACITACION Y FORMACION UBUNTU. Todos los derechos reservados. </h6>
        </div>
    </footer>

   

</body>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
        // Al abrir el modal, copiar datos del formulario a los campos ocultos
       document.querySelector('#inscribirseBtn').addEventListener('click', function() {
        const firstName = document.getElementById('firstName').value.trim();
        const lastName = document.getElementById('lastName').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        if (firstName && lastName && email && phone == null) {
          alert("null");
        }else if(firstName && lastName && email && phone) {
          document.getElementById('modalFirstName').value = firstName;
          document.getElementById('modalLastName').value = lastName;
          document.getElementById('modalEmail').value = email;
          document.getElementById('modalPhone').value = phone;

          const modal = new bootstrap.Modal(document.getElementById('comprobanteModal'));
          modal.show();
        }else{
          alert('Complete los campos antes de continuar.');
          location.reload();
        }
       });
       </script>
</html>
