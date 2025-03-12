<?php
try {
    $dbConnection = new PDO('mysql:host=localhost;dbname=u810780627_ubuntudb', 'u810780627_ubuntudb', 'contraseña');
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit;
}
?>

