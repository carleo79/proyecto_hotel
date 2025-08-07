<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reservaciones - Vista del Sol</title>
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
        
        <h2>GESTIÓN DE RESERVACIONES</h2>
        
        <div class="reservation-container">
            <form class="reservation-form" action="create.php" method="POST" onsubmit="return validarFormulario()">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fecha_entrada">Fecha de Entrada</label>
                        <input type="date" id="fecha_entrada" name="fecha_entrada" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="fecha_salida">Fecha de Salida</label>
                        <input type="date" id="fecha_salida" name="fecha_salida" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Ingrese el apellido" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="adultos">Adultos</label>
                        <select id="adultos" name="adultos" required>
                            <option value="">Seleccionar</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="kids">Niños</label>
                        <select id="kids" name="kids">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="tipo_habitacion">Tipo de Habitación</label>
                    <select id="tipo_habitacion" name="tipo_habitacion" required>
                        <option value="">Seleccionar</option>
                        <option value="1">Habitación Estándar</option>
                        <option value="2">Habitación Deluxe</option>
                        <option value="3">Suite</option>
                        <option value="4">Habitación Familiar</option>
                    </select>
                </div>
                
                <button type="submit" class="submit-btn">
                    <span>Registrar Reservación</span>
                    <small>Guardar información de la reservación</small>
                </button>
            </form>
        </div>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>