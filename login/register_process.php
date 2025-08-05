<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms = isset($_POST['terms']);
    
    // Validaciones
    $errors = [];
    
    if (empty($nombre) || empty($apellido)) {
        $errors[] = 'El nombre y apellido son obligatorios.';
    }
    
    if (empty($email)) {
        $errors[] = 'El correo electrónico es obligatorio.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Por favor, ingresa un correo electrónico válido.';
    }
    
    if (strlen($password) < 8) {
        $errors[] = 'La contraseña debe tener al menos 8 caracteres.';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Las contraseñas no coinciden.';
    }
    
    if (!$terms) {
        $errors[] = 'Debes aceptar los términos y condiciones.';
    }
    
    if (!empty($errors)) {
        $_SESSION['error'] = implode(' ', $errors);
        header('Location: register.php');
        exit();
    }
    
    try {
        $pdo = getConnection();
        
        // Verificar si el email ya existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'Este correo electrónico ya está registrado.';
            header('Location: register.php');
            exit();
        }
        
        // Crear el usuario
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellido, $email, $hashedPassword, 'cliente']);
        
        $_SESSION['success'] = 'Cuenta creada exitosamente. Ya puedes iniciar sesión.';
        header('Location: index.php');
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al crear la cuenta. Por favor, intenta nuevamente.';
        header('Location: register.php');
        exit();
    }
} else {
    header('Location: register.php');
    exit();
}
?> 