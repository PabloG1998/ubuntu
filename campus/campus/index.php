<?php 
    session_start();
    $host = 'localhost';
    $dbname = 'u810780627_ubuntudb';
    $user = 'u810780627_ubuntudb';
    $password = '';
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verify connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // SQL Query
        $query = "SELECT id, email, password, role FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0) {
            $stmt->bind_result($id, $email, $hashed_password, $role);
            $stmt->fetch();

            // Password verify
            if(password_verify($password, $hashed_password)) {
                // Session configuration
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;

                // Role redirect
                if($role == 'alumn') {
                    header("Location: ./index/index.php");
                } else if($role == 'admin') {
                    header("Location: ../users/content/admin/dashboardAdmin.php");
                } else {
                    $error = "Rol desconocido.";
                }
                exit();
            } else {
                $error = "Correo electrónico o contraseña incorrectos";
            }
        } else {
            $error = "Correo electrónico o contraseña incorrectos";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .gradient-custom {
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }
    </style>
</head>
<body>
    <nav class="menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="educational/courses/">Cursos</a></li>
            <li><a href="educational/workshops/">Talleres</a></li>
            <li><a href="institutional/accomaniment/">Acompañamientos</a></li>
            <li><a href="institutional/consultancy/">Consultoría</a></li>
            <li><a href="platform/register.php">Crear Cuenta</a></li>
            <li><a href="platform/login.php">Ingresar</a></li>
            <li><a href="campus/index.php">Campus</a></li>
        </ul>
    </nav>

    <!-- Login Form -->
    <form action="" method="POST">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">El mail y la contraseña son los de tu cuenta!</p>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="email" id="typeEmailX" name="email" class="form-control form-control-lg" required />
                                        <label class="form-label" for="typeEmailX">Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="password" id="typePasswordX" name="password" class="form-control form-control-lg" required />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>

                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                                </div>
                                <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <br>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <br><br><br>
                    <h5 class="text-uppercase">Enlaces útiles</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="./helpful-links/scopes/" class="text-white">Alcances</a></li>
                        <li><a href="./helpful-links/pricing/" class="text-white">Precios</a></li>
                        <li><a href="./jobs" class="text-white">Trabaja con nosotros</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <br><br><br>
                    <h5 class="text-uppercase">Contacto</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-white">Correo: info@empresa.com</a></li>
                        <li><a href="#" class="text-white">Teléfono: +123 456 7890</a></li>
                        <li><a href="#" class="text-white">Dirección: Calle Falsa 123</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
