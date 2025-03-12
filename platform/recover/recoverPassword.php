<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../resources/css/style.css">
    <link rel="shortcut icon" href="../resources/images/EagSKyL6nmIT5erqWDgzbASr0mrytrYTcFlevFtMJegeA8qwxTpQPhGOr3gchU.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Recuperar Contraseña | Ubuntu</title>
</head>
<body>
<nav class="menu">
  <ul>
    <li><a href="../../index.php">Inicio</a></li>
    <li><a href="../../educational/courses/">Cursos</a></li>
    <li><a href="../../educational/workshops/">Talleres</a></li>
    <li><a href="../../institutional/accomaniment/">Acompañamientos</a></li>
    <li><a href="../../institutional/consultancy/">Consultoria</a></li>
    <li><a href="../../platform/register.php">Crear Cuenta</a></li>
    <li><a href="../../platform/login.php">Ingresar</a></li>
  </ul>
</nav>

<div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Recuperar Contraseña</h2>

              <form id="resetPasswordForm">
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                    <label class="form-label" for="email">Correo Electrónico</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="password" id="newPassword" name="newPassword" class="form-control form-control-lg" required />
                    <label class="form-label" for="newPassword">Nueva Contraseña</label>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Actualizar Contraseña</button>
                </div>
              </form>

              <div id="responseMessage" class="mt-3"></div>
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
                    <h5 class="text-uppercase">Sobre nosotros</h5>
                    <p>
                        Información sobre la empresa, su misión, visión y valores. 
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Enlaces útiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Alcances</a></li>
                        <li><a href="#" class="text-white">Precios</a></li>
                        <li><a href="../jobs/" class="text-white">Trabaja con nosotros</a></li>
                     </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Correo: centrodecapacitacion.ubuntu@gmail.com </a></li>
                        <li><a href="#" class="text-white">Teléfono: 1165300745 - 45545310</a></li>
                        <li><a href="#" class="text-white">Dirección: Santiago Parodi 4330 - Caseros, 3 de Febrero, Pcia. Buenos Aires</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; 2024 CENTRO DE CAPACITACION Y FORMACION UBUNTU . Todos los derechos reservados.
        </div>
    </footer>

<script>
document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var email = document.getElementById('email').value;
    var newPassword = document.getElementById('newPassword').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'resetPassword.php', true); // Asegúrate de que la ruta es correcta
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        console.log(xhr.responseText); // Depuración de respuesta
        try {
            var response = JSON.parse(xhr.responseText);
            var messageElement = document.getElementById('responseMessage');

            if (response.success) {
                messageElement.innerHTML = "<div class='alert alert-success'>" + response.message + "</div>";
                setTimeout(function() {
                    window.location.href = '../login.php';
                }, 2000); // Redirige después de 2 segundos
            } else {
                messageElement.innerHTML = "<div class='alert alert-danger'>" + response.message + "</div>";
            }
        } catch (e) {
            console.error("Error al parsear JSON: ", e);
        }
    };

    xhr.send('email=' + encodeURIComponent(email) + '&newPassword=' + encodeURIComponent(newPassword));
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="../resources/js/script.js"></script> -->
</body>
</html>