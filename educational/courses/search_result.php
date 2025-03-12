<?php
$query = isset($_GET['query']) ? $_GET['query'] : '';

$host = 'localhost';
$dbname = 'u810780627_ubuntudb';
$user = 'u810780627_ubuntudb';
$password = '';
$conn;

$results = [];
if ($query) {
    $sql = "SELECT * FROM cursos WHERE nombre LIKE ? OR descripcion LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
    $stmt->execute();
    $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Resultados de búsqueda | Ubuntu</title>
</head>
<body>
    <!-- Menu -->
    <nav class="menu">
        <ul>
            <li><a href="../../index.php">Inicio</a></li>
            <li><a href="educational/courses/">Cursos</a></li>
            <li><a href="educational/workshops/">Talleres</a></li>
            <li><a href="institutional/accomaniment/">Acompañamientos</a></li>
            <li><a href="institutional/consultancy/">Consultoria</a></li>
            <li><a href="platform/register.php">Crear Cuenta</a></li>
            <li><a href="platform/login.php">Ingresar</a></li>
            <!-- Search -->
            <input class="search" type="search" placeholder="Buscar..." id="search" >
            <button class="btn btn-success">Buscar</button>
        </ul>
    </nav>

    <div class="container mt-5">
        <h1>Resultados de búsqueda para: "<?php echo htmlspecialchars($query); ?>"</h1>
        <div class="row">
            <?php if (count($results) > 0): ?>
                <?php foreach ($results as $result): ?>
                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($result['nombre']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($result['descripcion']); ?></p>
                                <a href="#" class="btn btn-primary">Crear una cuenta y anotarme</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron resultados para tu búsqueda.</p>
            <?php endif; ?>
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
                        <li><a href="#" class="text-white">Salida Laboral</a></li>
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
<script type="text/javascript" src="../../resources/js/script.js"></script>
<script type="text/javascript" src="../../resources/js/search.js"></script>
</html>s