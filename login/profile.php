<?php
session_start();
require_once 'db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_role = $_SESSION['user_role'];

// Obtener información actual del usuario
try {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    $_SESSION['error'] = 'Error al cargar la información del usuario.';
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Vista del Sol</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="../images/logo.png" alt="Vista del Sol" class="sidebar-logo">
                <h3>Panel de Control</h3>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <span class="nav-icon">🏠</span>
                            Dashboard
                        </a>
                    </li>
                    
                    <?php if ($user_role == 'admin'): ?>
                    <li class="nav-item">
                        <a href="../empleados/index.php" class="nav-link">
                            <span class="nav-icon">👥</span>
                            Empleados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../productos/index.php" class="nav-link">
                            <span class="nav-icon">📦</span>
                            Productos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../proveedores/index.php" class="nav-link">
                            <span class="nav-icon">🏢</span>
                            Proveedores
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../categorias/index.php" class="nav-link">
                            <span class="nav-icon">📂</span>
                            Categorías
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <li class="nav-item">
                        <a href="../reservaciones/index.php" class="nav-link">
                            <span class="nav-icon">📅</span>
                            Reservaciones
                        </a>
                    </li>
                    
                    <li class="nav-item active">
                        <a href="profile.php" class="nav-link">
                            <span class="nav-icon">👤</span>
                            Mi Perfil
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <span class="nav-icon">🚪</span>
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="dashboard-header">
                <div class="header-left">
                    <h1>Mi Perfil</h1>
                    <p>Gestiona tu información personal</p>
                </div>
                
                <div class="header-right">
                    <div class="user-info">
                        <span class="user-role"><?php echo ucfirst($user_role); ?></span>
                        <span class="user-email"><?php echo htmlspecialchars($user_email); ?></span>
                    </div>
                </div>
            </header>
            
            <div class="dashboard-content">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-error">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
                
                <div class="profile-container">
                    <div class="profile-card">
                        <h2>Información Personal</h2>
                        <form action="update_profile.php" method="POST" class="profile-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($user['apellido']); ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            
                            <button type="submit" class="login-btn">Actualizar Información</button>
                        </form>
                    </div>
                    
                    <div class="profile-card">
                        <h2>Cambiar Contraseña</h2>
                        <form action="change_password.php" method="POST" class="profile-form">
                            <div class="form-group">
                                <label for="current_password">Contraseña Actual</label>
                                <input type="password" id="current_password" name="current_password" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="new_password">Nueva Contraseña</label>
                                <input type="password" id="new_password" name="new_password" required>
                                <small>Mínimo 8 caracteres</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_new_password">Confirmar Nueva Contraseña</label>
                                <input type="password" id="confirm_new_password" name="confirm_new_password" required>
                            </div>
                            
                            <button type="submit" class="login-btn">Cambiar Contraseña</button>
                        </form>
                    </div>
                    
                    <div class="profile-card">
                        <h2>Información de la Cuenta</h2>
                        <div class="account-info">
                            <div class="info-item">
                                <span class="info-label">Rol:</span>
                                <span class="info-value"><?php echo ucfirst($user['rol']); ?></span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Estado:</span>
                                <span class="info-value <?php echo $user['estado'] == 'activo' ? 'status-active' : 'status-inactive'; ?>">
                                    <?php echo ucfirst($user['estado']); ?>
                                </span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Fecha de Registro:</span>
                                <span class="info-value"><?php echo date('d/m/Y', strtotime($user['fecha_creacion'])); ?></span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Última Actualización:</span>
                                <span class="info-value"><?php echo date('d/m/Y H:i', strtotime($user['fecha_actualizacion'])); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html> 