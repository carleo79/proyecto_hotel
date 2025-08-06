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
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    
    // Validaciones
    if (empty($nombre) || empty($apellido)) {
        $_SESSION['error'] = 'El nombre y apellido son obligatorios.';
        header('Location: profile.php');
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Por favor, ingresa un correo electrónico válido.';
        header('Location: profile.php');
        exit();
    }
    
    try {
        $pdo = getConnection();
        
        // Verificar si el email ya existe en otro usuario
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
        $stmt->execute([$email, $user_id]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Este correo electrónico ya está en uso por otro usuario.';
            header('Location: profile.php');
            exit();
        }
        
        // Actualizar información del usuario
        $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ? WHERE id = ?");
        $stmt->execute([$nombre, $apellido, $email, $user_id]);
        
        // Actualizar variables de sesión
        $_SESSION['user_name'] = $nombre . ' ' . $apellido;
        $_SESSION['user_email'] = $email;
        
        $_SESSION['success'] = 'Información actualizada exitosamente.';
        header('Location: profile.php');
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al actualizar la información. Por favor, intenta nuevamente.';
        header('Location: profile.php');
        exit();
    }
} else {
    header('Location: profile.php');
    exit();
}
?> 