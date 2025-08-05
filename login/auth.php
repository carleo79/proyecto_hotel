<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);
    
    // Validaciones básicas
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Por favor, completa todos los campos.';
        header('Location: index.php');
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Por favor, ingresa un correo electrónico válido.';
        header('Location: index.php');
        exit();
    }
    
    try {
        $pdo = getConnection();
        
        // Buscar usuario por email
        $stmt = $pdo->prepare("SELECT id, nombre, apellido, email, password, rol FROM usuarios WHERE email = ? AND estado = 'activo'");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login exitoso
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'] . ' ' . $user['apellido'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['rol'];
            $_SESSION['login_time'] = time();
            
            // Si marcó "recordarme", crear cookie
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $expires = time() + (30 * 24 * 60 * 60); // 30 días
                
                // Guardar token en la base de datos
                $stmt = $pdo->prepare("UPDATE usuarios SET remember_token = ?, token_expires = ? WHERE id = ?");
                $stmt->execute([$token, date('Y-m-d H:i:s', $expires), $user['id']]);
                
                setcookie('remember_token', $token, $expires, '/', '', true, true);
            }
            
            // Registrar el login
            $stmt = $pdo->prepare("INSERT INTO login_logs (user_id, ip_address, user_agent, login_time) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$user['id'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']]);
            
            $_SESSION['success'] = '¡Bienvenido de vuelta!';
            header('Location: dashboard.php');
            exit();
            
        } else {
            $_SESSION['error'] = 'Credenciales incorrectas. Por favor, verifica tu correo y contraseña.';
            header('Location: index.php');
            exit();
        }
        
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error en el servidor. Por favor, intenta nuevamente.';
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?> 