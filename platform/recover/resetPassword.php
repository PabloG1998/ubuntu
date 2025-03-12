<?php
header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

$host = "localhost";
$user = "root";
$password = "";
$dbname = "ubuntu";


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $newPassword = $_POST['newPassword'];

        // Verificar si el correo electrónico existe en la base de datos
        $sql = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Actualizar la contraseña en la base de datos
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET password = :password WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['password' => $hashedPassword, 'email' => $email]);

            echo json_encode([
                'success' => true,
                'message' => 'Contraseña actualizada correctamente. Redirigiendo al inicio de sesión...',
                'redirect' => 'platform/login.php' // Añadido para la redirección
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'El correo electrónico no está registrado.'
            ]);
        }
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}

$pdo = null;
?>
