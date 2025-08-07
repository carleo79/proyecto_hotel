<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores - Vista del Sol</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Botón de regreso -->
    <a href="../login/dashboard.php" class="back-button">Volver al Dashboard</a>

    <div class="container">
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert <?php echo strpos($_GET['mensaje'], 'exitosamente') !== false ? 'success' : 'error'; ?>">
                <?php echo htmlspecialchars($_GET['mensaje']); ?>
            </div>
        <?php endif; ?>
        
        <h2>GESTIÓN DE PROVEEDORES</h2>
        
        <div class="provider-container">
            <form class="provider-form" action="create.php" method="POST" onsubmit="return validarFormulario()">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre del Proveedor</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del proveedor" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contacto">Contacto</label>
                        <input type="text" id="contacto" name="contacto" placeholder="Ingrese el nombre del contacto" required>
                    </div>
                </div>
                

                
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección completa" required>
                </div>
                
                <button type="submit" class="submit-btn">
                    <span>Registrar Proveedor</span>
                    <small>Guardar información del proveedor</small>
                </button>
            </form>
        </div>

        <h2>Proveedores Existentes</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'read.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html> 