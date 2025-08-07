<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías - Vista del Sol</title>
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
        
        <h2>GESTIÓN DE CATEGORÍAS</h2>
        <p>Administra las categorías de productos del hotel</p>
        
        <div class="category-container">
            <form class="category-form" action="create.php" method="POST" onsubmit="return validarFormulario()">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre de la Categoría</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre de la categoría" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripción de la categoría" required>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    <span>Registrar Categoría</span>
                    <small>Guardar información de la categoría</small>
                </button>
            </form>
        </div>

        <h2>Categorías Existentes</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
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