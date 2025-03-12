<?php
// Conexión a la base de datos
$host = "localhost";
$user = "u810780627_ubuntudb";
$password = "Ubuntu2020sql";
$dbname = "u810780627_ubuntudb";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];

        // Verificar si el correo electrónico existe en la base de datos
        $sql = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generar un token de recuperación de contraseña
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token válido por 1 hora

            // Guardar el token en la base de datos
            $sql = "INSERT INTO password_resets (email, token, expiry) VALUES (:email, :token, :expiry)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email, 'token' => $token, 'expiry' => $expiry]);

            // Enviar respuesta de éxito para mostrar el mensaje
            echo json_encode(['success' => true, 'message' => 'Actualización de contraseña exitosa.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'El correo electrónico no está registrado.']);
        }
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$pdo = null;
?>