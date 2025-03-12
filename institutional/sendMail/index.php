<?php 

//Hostinger
$host = 'localhost';
$dbname = 'u810780627_ubuntudb';
$user = 'u810780627_ubuntudb';
$password = 'Ubuntu2020sql';
//Localhost
/*
    // Configuración de la base de datos
    $host = "localhost";
    $dbname = "ubuntudb";
    $user = "root";
    $password = ""; // Cambié '$pass' por '$password'
  */  
    // Conexión a la base de datos
    $conn = new mysqli($host, $user, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión Fallida: " . $conn->connect_error); // Cambié '$con' por '$conn'
    }

    // Procesar los datos solo si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $mensaje = $_POST['mensaje'];

        // Validar datos si es necesario (por ejemplo, un email válido)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "El correo electrónico no es válido.";
            exit;
        }

        // Escapar los datos para evitar inyecciones SQL
        $nombre = $conn->real_escape_string($nombre);
        $apellido = $conn->real_escape_string($apellido);
        $email = $conn->real_escape_string($email);
        $mensaje = $conn->real_escape_string($mensaje);

        // Preparar la consulta SQL
        $sql = "INSERT INTO mensajes (nombre, apellido, email, mensaje)
                VALUES ('$nombre', '$apellido', '$email', '$mensaje')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Mensaje enviado correctamente";
            header("Location: " .$_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error al enviar el mensaje: " . $conn->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/styles.css">
    <link rel="shortcut icon" href="resources/images/EagSKyL6nmIT5erqWDgzbASr0mrytrYTcFlevFtMJegeA8qwxTpQPhGOr3gchU.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="body">
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
          <a class="nav-link active" href="./index.php">Inicio</a>
        </li>
         <li class="nav-item">      
          <a class="nav-link" aria-current="page" href="educational/courses">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="educational/workshops">Talleres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="institutional/accomaniment">Acompañamientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="institutional/consultancy/">Consultoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="platform/register.php">Crear Cuenta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="platform/login.php">Ingresar</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./educational/pdf-word/habilitacion.pdf" target="_blank">Habilitacion</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./educational/pdf-word/mde.pdf" target="_blank">Metodología de Enseñanza</a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Programas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./educational/pdf-word/t.pdf" target="_blank">Diplomatura Acompañante Terapeutico</a></li>
            <li><a class="dropdown-item" href="./educational/pdf-word/tbb.pdf" target="_blank">Taller Biodecodifiación Biológica</a></li>
            <li><a class="dropdown-item" href="./educational/pdf-word/pco.pdf" target="_blank">Diplomatura Couching Ontologico y Programación Neurolinguistica(PNL)</a></li>
            <li><a class="dropdown-item" href="./educational/pdf-word/opsca.pdf" target="_blank">Diplomatura Operador SocioComunitario en Adicciones</a></li>
            <li><a class="dropdown-item" href="./educational/pdf-word/tfsb.pdf" target="_blank">Terapeuta Floral en Sistema Bach</a></li>
            <li><a class="dropdown-item" href="#"></a></li>
            </ul>

        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-exapanded="false">
            Redes Sociales
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" target="_blank">Facebook</a></li>
            <li><a class="dropdown-item" href="#" target="_blank">Instgram</a></li>
            <li><a class="dropdown-item" href="./institutional/sendMail">Enviar Mail</a></li>
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

<!--Form-->
<br>
<div class="container mt-5">
    <h2>Formulario de Contacto</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email", name="email" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>    
    </form>
</div>
<br> <br>
</body>
  <!-- Footer -->
  
  <footer class="bg-dark text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                   <h5 class="text-uppercase">
                  
                    
                </div>
                <center>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Enlaces útiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="./helpful-links/scopes/" class="text-white">Alcances</a></li>
                        <li><a href="./helpful-links/pricing/" class="text-white">Precios</a></li>
                        <li><a href="platform/jobs" class="text-white">Trabaja con nosotros</a></li>
                        <li><a href="#" class="text-white"></a></li> 
                     </ul>
                </div>
          </center>
                <hr>
                <center>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Correo: centrodecapacitacion.ubuntu@gmail.com</a></li>
                        <li><a href="#" class="text-white">Teléfono: 1165300745 - 45545310</a></li>
                        <li><a href="#" class="text-white">Dirección: Santiago Parodi 4330 - Caseros, 3 de Febrero. Pcia.Buenos Aires</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </center>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
          <!--Logos-->
          <img src="resources/images/LOGO COMISION EN BLANCO.png" alt="Logo comision" height="150" width="150">
          <img src="resources/images/Grupo educativo LOGO BLANCO.png" alt="Logo grupo eduactivo" height="150" width="150">
          <img src="resources/images/logo-nuevo.png" alt="logo centro" height="150" width="150">
          <img src="resources/images/CentrodeFormacionyCapacitacionUBUNTU.jpg" alt="Certificacion UBUNTU" width="400" height="200">

         <h6> &copy; 2024 CENTRO DE CAPACITACION Y FORMACION UBUNTU. Todos los derechos reservados. </h6>
        </div>
    </footer>
  

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="resources/js/script.js"></script>
</html>
</html>