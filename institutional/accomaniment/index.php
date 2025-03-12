<?php

// Conexión a la base de datos


//Localhost

$servername = "localhost";
$dbname = "ubuntu";
$username = "root";
$password = "";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consultar acompañamientos
$sql = "SELECT id, nombre FROM acompanamientos";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/css/styles.css">
    <link rel="shortcut icon" href="../../resources/images/EagSKyL6nmIT5erqWDgzbASr0mrytrYTcFlevFtMJegeA8qwxTpQPhGOr3gchU.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Acompañamiento | Ubuntu</title>
</head>

<body class="body">
    <!-- Menu -->
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
          <a class="nav-link" href="../../index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../../educational/courses">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../educational/workshops">Talleres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../institutional/accomaniment">Acompañamientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../institutional/consultancy/">Consultoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../platform/register.php">Crear Cuenta</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../../news/news.php">Noticias</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="../../platform/login.php">Ingresar</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../../educational/pdf-word/habilitacion.pdf" target="_blank">Habilitacion</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../../educational/pdf-word/mde.pdf" target="_blank">Metodología de Enseñanza</a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Programas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../../educational/pdf-word/t.pdf" target="_blank">Diplomatura Acompañamiento Terapeutico</a></li>
            <li><a class="dropdown-item" href="../../educational/pdf-word/tbb.pdf" target="_blank">Taller Biodecodifiación Biológica</a></li>
            <li><a class="dropdown-item" href="../../educational/pdf-word/pco.pdf" target="_blank">Diplomatura Coaching Ontologico y Programación Neurolinguistica(PNL)</a></li>
            <li><a class="dropdown-item" href="../../educational/pdf-word/opsca.pdf" target="_blank">Diplomaura Operador Socio-Comunitario en Adicciones</a></li>
            <li><a class="dropdown-item" href="../../educational/pdf-word/tfsb.pdf" target="_blank">Terapeuta Floral en Sistema Bach</a></li>
            <li><a class="dropdown-item" href="#"></a></li>
          </ul>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-exapanded="false">
            Redes Sociales
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="https://www.facebook.com/profile.php?id=61568240931887" target="_blank">Facebook</a></li>
            <li><a class="dropdown-item" href="https://www.instagram.com/centrodecapacitacion.ubuntu" target="_blank">Instgram</a></li>
          </ul>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <!-- Content -->
    <div class="contenido">
      <br>
       <center> <h1>Consultas para personas con problemas de adicciones.</h1>
        <ol>
            <ul>Acompañamiento Terapeutico</ul>
            <ul>Sesiones individuales</ul>
            <ul>Acompañamiento a las familias con problemas de <b>Consumos Problematicos</b></ul>
            <ul><b>Tratamiento para desbloquear</b> tu árbol genealógico y biodescodificar tus sentimientos y emociones</ul>
        </ol
        </center>
    </div>
    <!--Content-->
    <h1>Diego Martin Nace</h1>
    <hr>
    <p>Psicologo Social en <b>Adicciones</b></p><br>
    <hr>
    <p>Consultor Psicológico</p><br>
    <hr>
    <p>Biodecodificador Ontologico</p><br>
    <hr>
    <p>Terapeuta en Flores de Bach</p><br>
    <hr>
    <p>Acompañante terapéutico en Adicciones</p><br>
    <hr>
    <h2>Sesiones Individuales</h2>
    <li>
      <ol>Multifamiliares</ol>
      <ol>Sesiones virtuales y Presenciales</ol>
     
      <button type="button" class="btn btn-success" onclick="ver()">Ver Teléfono</button>
<script>
  var ver = function() {
    alert("Teléfono: +54 9 11 6530-0745");
  };
</script>
    </li>
    <center>
    <div class="imagen-acompañamiento">
      <!--
        <img src="../../resources/images/acomp.jpg" alt="Acompañamiento Terapeutico" srcset="" height="434" width="400">
-->
      </div>
    </center>

   
   
    <div class="container mt-4">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Mostrar acompañamientos en las tarjetas
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $nombre = htmlspecialchars($row["nombre"]);
                    $detalles = htmlspecialchars($row["detalles"]);

                    echo '<div class="col-sm-6 mb-3">';
                    echo '  <div class="card">';
                    echo '    <div class="card-body">';
                    echo '      <h5 class="card-title">' . $nombre . '</h5>';
                    echo '      <p class="card-text">' . $detalles . '</p>';
                    echo '      <a href="id/' . $id . '" class="btn btn-primary">Ver detalle</a>';
                    echo '    </div>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay acompañamientos disponibles.</p>';
            }
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                   <h5 class="text-uppercase"></h5>
                    <p>
                        
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Enlaces útiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="./helpful-links/scopes/" class="text-white">Alcances</a></li>
                        <li><a href="./helpful-links/pricing/" class="text-white">Precios</a></li>
                        <li><a href="../../platform/jobs/" class="text-white">Trabaja con nosotros</a></li>
                        <li><a href="#" class="text-white"></a></li> 
                     </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Correo: centrodecapacitacion.ubuntu@gmail.com </a></li>
                        <li><a href="#" class="text-white">Teléfono: 1165300745 - 45545310</a></li>
                        <li><a href="#" class="text-white">Dirección: Santiago Parodi 4330 - Caseros, 3 de Febrero. Pcia.Buenos Aires</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <img src="../../resources/images/LOGO COMISION EN BLANCO.png" alt="Logo comision" height="150" width="150">
          <img src="../../resources/images/Grupo educativo LOGO BLANCO.png" alt="Logo grupo eduactivo" height="150" width="150">
          <img src="../../resources/images/logo-nuevo.png" alt="logo centro" height="150" width="150">
         <h6> &copy; 2024 CENTRO DE CAPACITACION Y FORMACION UBUNTU. Todos los derechos reservados. </h6>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../resources/js/script.js"></script>
</body>
</html>
