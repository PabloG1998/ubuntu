<?php 
// Conexión a la base de datos
//Hostinger

$host = 'localhost';
$dbname = 'u810780627_ubuntudb';
$user = 'u810780627_ubuntudb';
$password = 'Ubuntu2020sql';


//Localhost
/*
$host = "localhost";
$dbname = "ubuntudb";
$user = "root";
$password = "";
*/
// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="shortcut icon" href="../resources/images/EagSKyL6nmIT5erqWDgzbASr0mrytrYTcFlevFtMJegeA8qwxTpQPhGOr3gchU.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Iniciar Sesión | Ubuntu</title>
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
          <a class="nav-link" href="../index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../educational/courses">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../educational/workshops">Talleres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../institutional/accomaniment">Acompañamientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../institutional/consultancy/">Consultoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../platform/register.php">Crear Cuenta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../platform/login.php">Ingresar</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../educational/pdf-word/habilitacion.pdf" target="_blank">Habilitacion</a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Programas
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../educational/pdf-word/t.pdf" target="_blank">Acompañamiento Terapeutico</a></li>
            <li><a class="dropdown-item" href="../educational/pdf-word/tbb.pdf" target="_blank">Taller Biodecodifiación Biológica</a></li>
            <li><a class="dropdown-item" href="../educational/pdf-word/pco.pdf" target="_blank">Coaching Ontologico</a></li>
            <li><a class="dropdown-item" href="../educational/pdf-word/opsca.pdf" target="_blank">Operador Socio-Comunitario en Adicciones</a></li>
            <li><a class="dropdown-item" href="../educational/pdf-word/tfsb.pdf" target="_blank">Terapeuta Floral en Sistema Bach</a></li>
            <li><a class="dropdown-item" href="#"></a></li>

          </ul>

        </li>
      </ul>
    </div>
  </div>
</nav>

    <!-- Formulario de Inicio de Sesión -->
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Iniciar Sesión</h2>

                            <form action="log_user.php" method="POST">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="mail" name="email" class="form-control form-control-lg" required />
                                    <label class="form-label" for="mail">Mail</label>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                    <label class="form-label" for="password">Contraseña</label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Olvidó su contraseña? <a href="recover/recoverPassword.php" class="fw-bold text-body"><u>Recuperar contraseña</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                        <li><a href="./jobs" class="text-white">Trabaja con nosotros</a></li>
                        <li><a href="#" class="text-white"></a></li> 
                     </ul>
                </div>
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
        <img src="../resources/images/LOGO COMISION EN BLANCO.png" alt="Logo comision" height="150" width="150">
          <img src="../resources/images/Grupo educativo LOGO BLANCO.png" alt="Logo grupo eduactivo" height="150" width="150">
          <img src="../resources/images/logo-nuevo.png" alt="logo centro" height="150" width="150">
         <h6> &copy; 2024 CENTRO DE CAPACITACION Y FORMACION UBUNTU. Todos los derechos reservados. </h6>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../resources/js/script.js"></script>
</body>

</html>
