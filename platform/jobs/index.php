<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/style.css">
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
          <a class="nav-link active" aria-current="page" href="../../educational/courses">Cursos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../educational/workshops">Talleres</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../educactional/accomaniment">Acompañamientos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../educactional/consultancy">Consultoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../platform/register.php">Crear Cuenta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../platform/login.php">Ingresar</a>
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
<br>
<!--Content-->
<div class="alert alert-danger" role="alert">
  Importante! El Curriculum debe tener como nombre CurriculumVitae (fecha, nombre y cargo) y debe ser en formato PDF o DOC
</div>
<div class="alert alert-warning" role="alert">
  Ejemplo: CurriculumVitaePabloNicolasGarciaProgramadorWeb
</div>

<!-- CV Form -->
<form action="./upload_cv.php" method="post" enctype="multipart/form-data" style="text-align: center;">
    <h2>Subir Curriculum Vitae</h2>
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="cvFile" class="form-label">Archivo (PDF o DOC)</label>
        <input type="file" class="form-control" name="cvFile" id="cvFile" accept=".pdf, .doc, .docx" required>
    </div>
    <button type="submit" class="btn btn-primary">Subir CV</button>
</form>


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
                        <li><a href="#" class="text-white">Trabaja con nosotros</a></li>
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
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <img src="../../resources/images/LOGO COMISION EN BLANCO.png" alt="Logo comision" height="150" width="150">
          <img src="../../resources/images/Grupo educativo LOGO BLANCO.png" alt="Logo grupo eduactivo" height="150" width="150">
          <img src="../../resources/images/logo-nuevo.png" alt="logo centro" height="150" width="150">
         <h6> &copy; 2024 CENTRO DE CAPACITACION Y FORMACION UBUNTU. Todos los derechos reservados. </h6>
        </div>
    </footer>
  

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="resources/js/script.js"></script>
</html>