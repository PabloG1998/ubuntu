<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $comentario = $_POST['comentario'];

    //conexion
    $conn = new mysqli("localhost", "root", "", "ubuntudb");

    //verificar
    if($conn->connect_error) {
        die("Conexion fallida: " . $conn->connect_error);
    }

    //Preparar y ejecutar la ins
    $stmt = $conn->prepare("insert into comentarios (nombre, comentario) values (?, ?)");
    $stmt->bind_param("ss", $nombre, $comentario);

    if ($stmt->execute()) {
        echo "Comentario guardado correctamente";
    }else{
        echo "Error al guardar el comentario: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

?>