<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Vista del Sol</title>
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
        
        <h2>GESTIÓN DE PRODUCTOS</h2>
        
        <div class="product-container">
            <form class="product-form" action="create.php" method="POST" onsubmit="return validarFormulario()">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input type="text" id="nombre_producto" name="nombre_producto" placeholder="Ingrese el nombre del producto" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripción del producto" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="precio_unitario">Precio (COP)</label>
                        <input type="number" id="precio_unitario" name="precio_unitario" placeholder="Ingrese el precio en pesos colombianos" step="0.01" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cantidad_disponible">Cantidad Disponible</label>
                        <input type="number" id="cantidad_disponible" name="cantidad_disponible" placeholder="Ingrese la cantidad disponible" required>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    <span>Registrar Producto</span>
                    <small>Guardar información del producto</small>
                </button>
            </form>
        </div>

        <h2>Productos Existentes</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
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