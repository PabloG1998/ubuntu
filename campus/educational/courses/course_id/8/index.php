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
    <li><a href="institutional/consultancy/">Consultoria</a></li>
    <li><a href="platform/register.php">Crear Cuenta</a></li>
    <li><a href="platform/login.php">Ingresar</a></li>
    <!-- Search -->
  <!--  <input class="search" type="search" placeholder="Buscar..." id="search" >
    <button class="btn btn-success">Buscar</button> -->
  </ul>
  
 
</nav>

<br> <br>
<!--Content-->
    <!--Inscription Form-->
        <div class="container mt-5">
            <h2>Formulario de Inscripción</h2>
            <form id="RegistrationForm">
                <div class="mb-3">
                    <label for="firstName" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="firstName" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="lastName" required> 
                </div>
                <div class="mb3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" required>
                </div>
                <div class="mb3">
                    <label for="phone" class="form-label">Telefono</label>
                    <input type="tel" class="form-control" id="phone" required>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bankmodal">Inscribirse</button>
            </form>
        </div>

        <!--Modal (Datos Bancarios) -->
        <div class="modal-fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                       <!-- <h5 class="modal-title">Datos Bancarios</h5> -->
                        <h5>Al inscribirse, se le enviara un mensaje con los datos bancarios. Luego deberá
                            enviar el comprobante tanto por Whatsapp como por el presente formulario.
                        </h5>
                    </div>
                </div>
            </div>
        </div>

 <!-- Footer -->
 <footer class="bg-dark text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sobre nosotros</h5>
                    <p>
                        Información sobre la empresa, su misión, visión y valores. 
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Enlaces útiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="./helpful-links/scopes/" class="text-white">Alcances</a></li>
                        <li><a href="./helpful-links/pricing/" class="text-white">Precios</a></li>
                        <li><a href="./jobs" class="text-white">Trabaja con nosotros</a></li>
                       <!-- <li><a href="#" class="text-white"></a></li> -->
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript" src="resources/js/script.js"></script>
</html>