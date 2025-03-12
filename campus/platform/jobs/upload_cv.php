<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "u810780627_ubuntudb";
$password = "Ubuntu2020sql";
$dbname = "u810780627_ubuntudb";


$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    // Verificar si se ha enviado el archivo
    if (isset($_FILES['cvFile']) && $_FILES['cvFile']['error'] === UPLOAD_ERR_OK) {
        $cvFile = $_FILES['cvFile'];

        // Ruta para guardar el archivo
        $uploadDir = 'curriculums/';
        $fileName = basename($cvFile['name']);
        $uploadFilePath = $uploadDir . $fileName;

        // Verificar si el archivo ya existe
        if (file_exists($uploadFilePath)) {
            echo "Error: El archivo ya existe. Por favor, renómbralo y vuelve a intentarlo.";
        } else {
            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($cvFile['tmp_name'], $uploadFilePath)) {
                // Guardar en la base de datos
                $stmt = $conn->prepare("INSERT INTO cvs (name, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $name, $uploadFilePath);

                if ($stmt->execute()) {
                    echo "CV subido exitosamente.";
                } else {
                    echo "Error al guardar en la base de datos: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error al mover el archivo a la carpeta de destino.";
            }
        }
    } else {
        // Mostrar el error si el archivo no se ha enviado o ha ocurrido un error
        if (isset($_FILES['cvFile'])) {
            echo "Error en la subida del archivo: " . $_FILES['cvFile']['error'];
        } else {
            echo "No se ha enviado ningún archivo.";
        }
    }
}

$conn->close();
?>
