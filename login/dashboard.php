<?php
session_start();
require_once 'db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Obtener información del usuario
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_role = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Vista del Sol</title>
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
                    <li class="nav-item active">
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
                    
                    <li class="nav-item">
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
                    <h1>Bienvenido, <?php echo htmlspecialchars($user_name); ?></h1>
                    <p>Panel de control de Vista del Sol</p>
                </div>
                
                <div class="header-right">
                    <div class="user-info">
                        <span class="user-role"><?php echo ucfirst($user_role); ?></span>
                        <span class="user-email"><?php echo htmlspecialchars($user_email); ?></span>
                    </div>
                </div>
            </header>
            
            <div class="dashboard-content">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📅</div>
                        <div class="stat-info">
                            <h3>Reservaciones</h3>
                            <p class="stat-number">25</p>
                            <p class="stat-label">Este mes</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-info">
                            <h3>Empleados</h3>
                            <p class="stat-number">12</p>
                            <p class="stat-label">Activos</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">📦</div>
                        <div class="stat-info">
                            <h3>Productos</h3>
                            <p class="stat-number">150</p>
                            <p class="stat-label">En inventario</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>
                        <div class="stat-info">
                            <h3>Ingresos</h3>
                            <p class="stat-number">$45,250</p>
                            <p class="stat-label">Este mes</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2>Acciones Rápidas</h2>
                    <div class="actions-grid">
                        <a href="../reservaciones/create.php" class="action-card">
                            <span class="action-icon">➕</span>
                            <h3>Nueva Reservación</h3>
                            <p>Crear una nueva reservación</p>
                        </a>
                        
                        <a href="../empleados/create.php" class="action-card">
                            <span class="action-icon">👤</span>
                            <h3>Nuevo Empleado</h3>
                            <p>Registrar un nuevo empleado</p>
                        </a>
                        
                        <a href="../productos/create.php" class="action-card">
                            <span class="action-icon">📦</span>
                            <h3>Nuevo Producto</h3>
                            <p>Agregar producto al inventario</p>
                        </a>
                        
                        <a href="profile.php" class="action-card">
                            <span class="action-icon">⚙️</span>
                            <h3>Mi Perfil</h3>
                            <p>Editar información personal</p>
                        </a>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="recent-activity">
                    <h2>Actividad Reciente</h2>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">📅</div>
                            <div class="activity-content">
                                <h4>Nueva reservación creada</h4>
                                <p>Habitación 201 - Juan Pérez</p>
                                <span class="activity-time">Hace 2 horas</span>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">👤</div>
                            <div class="activity-content">
                                <h4>Empleado registrado</h4>
                                <p>María González - Recepcionista</p>
                                <span class="activity-time">Hace 1 día</span>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon">📦</div>
                            <div class="activity-content">
                                <h4>Producto agregado</h4>
                                <p>Toallas de baño - 50 unidades</p>
                                <span class="activity-time">Hace 2 días</span>
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