<?php
session_start();
require_once 'db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];
    
    // Validaciones
    if (empty($current_password) || empty($new_password) || empty($confirm_new_password)) {
        $_SESSION['error'] = 'Todos los campos son obligatorios.';
        header('Location: profile.php');
        exit();
    }
    
    if (strlen($new_password) < 8) {
        $_SESSION['error'] = 'La nueva contraseña debe tener al menos 8 caracteres.';
        header('Location: profile.php');
        exit();
    }
    
    if ($new_password !== $confirm_new_password) {
        $_SESSION['error'] = 'Las contraseñas no coinciden.';
        header('Location: profile.php');
        exit();
    }
    
    try {
        $pdo = getConnection();
        
        // Verificar contraseña actual
        $stmt = $pdo->prepare("SELECT password FROM usuarios WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
        
        if (!$user || !password_verify($current_password, $user['password'])) {
            $_SESSION['error'] = 'La contraseña actual es incorrecta.';
            header('Location: profile.php');
            exit();
        }
        
        // Verificar que la nueva contraseña sea diferente a la actual
        if (password_verify($new_password, $user['password'])) {
            $_SESSION['error'] = 'La nueva contraseña debe ser diferente a la actual.';
            header('Location: profile.php');
            exit();
        }
        
        // Actualizar contraseña
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
        $stmt->execute([$hashedPassword, $user_id]);
        
        $_SESSION['success'] = 'Contraseña cambiada exitosamente.';
        header('Location: profile.php');
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al cambiar la contraseña. Por favor, intenta nuevamente.';
        header('Location: profile.php');
        exit();
    }
} else {
    header('Location: profile.php');
    exit();
}
?> 