<?php
// Conexión a la base de datos

$host = 'localhost';
$dbname = 'ubuntu';
$user = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];
        
        // Verificar el token
        $sql = "SELECT email FROM password_resets WHERE token = :token AND expiry > NOW()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['token' => $token]);
        $reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($reset) {
            $email = $reset['email'];
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

            // Actualizar la contraseña en la base de datos
            $sql = "UPDATE usuarios SET password = :password WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['password' => $hashedPassword, 'email' => $email]);

            // Eliminar el token usado
            $sql = "DELETE FROM password_resets WHERE token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['token' => $token]);

            echo "Contraseña actualizada exitosamente.";
        } else {
            echo "Token de recuperación inválido o expirado.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>