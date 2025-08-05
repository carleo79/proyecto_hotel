<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'hotel_reservas_5');
define('DB_USER', 'root');
define('DB_PASS', '');

function getConnection() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

// Función para verificar si las tablas necesarias existen
function checkTables() {
    try {
        $pdo = getConnection();
        
        // Verificar si existe la tabla usuarios
        $stmt = $pdo->query("SHOW TABLES LIKE 'usuarios'");
        if ($stmt->rowCount() == 0) {
            createUsersTable($pdo);
        }
        
        // Verificar si existe la tabla login_logs
        $stmt = $pdo->query("SHOW TABLES LIKE 'login_logs'");
        if ($stmt->rowCount() == 0) {
            createLoginLogsTable($pdo);
        }
        
        // Crear usuario administrador por defecto si no existe
        createDefaultAdmin($pdo);
        
    } catch (PDOException $e) {
        die("Error al verificar tablas: " . $e->getMessage());
    }
}

function createUsersTable($pdo) {
    $sql = "CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        rol ENUM('admin', 'empleado', 'cliente') DEFAULT 'cliente',
        estado ENUM('activo', 'inactivo') DEFAULT 'activo',
        remember_token VARCHAR(64) NULL,
        token_expires DATETIME NULL,
        fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
}

function createLoginLogsTable($pdo) {
    $sql = "CREATE TABLE login_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        ip_address VARCHAR(45) NOT NULL,
        user_agent TEXT,
        login_time DATETIME NOT NULL,
        FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
    )";
    
    $pdo->exec($sql);
}

function createDefaultAdmin($pdo) {
    // Verificar si ya existe un administrador
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE rol = 'admin' LIMIT 1");
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        // Crear usuario administrador por defecto
        $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(['Administrador', 'Sistema', 'admin@vistadelsol.com', $adminPassword, 'admin']);
        
        echo "<script>console.log('Usuario administrador creado: admin@vistadelsol.com / admin123');</script>";
    }
}

// Verificar tablas al cargar el archivo
checkTables();
?> 