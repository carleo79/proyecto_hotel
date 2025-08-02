<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones - Hotel Cartagena</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Botón de regreso -->
    <a href="../index.html" class="back-button">Volver al Inicio</a>
    
    <div class="container">
        <h2>RESERVACIONES</h2>
        
        
        <div class="reservation-container">
            <form class="reservation-form" id="reservationForm" action="create.php" method="POST" >
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
                        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" required>
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
                
                <div class="price-summary">
                    <div class="price-item">
                        <span>Precio por noche:</span>
                        <span class="price">$150.000</span>
                    </div>
                    <div class="price-item">
                        <span>Noches:</span>
                        <span id="nights">0</span>
                    </div>
                    <div class="price-total">
                        <span>Total:</span>
                        <span class="total-price">$0</span>
                    </div>
                </div>
                
                <button type="submit" class="reserve-btn">
                    <span>Reservar Ahora</span>
                    <small>Confirmación inmediata</small>
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // JavaScript simplificado inline
        document.addEventListener('DOMContentLoaded', function() {
            console.log('JavaScript cargado correctamente');
            
            const fechaEntradaInput = document.getElementById('fecha_entrada');
            const fechaSalidaInput = document.getElementById('fecha_salida');
            const tipoHabitacionSelect = document.getElementById('tipo_habitacion');
            const nightsSpan = document.getElementById('nights');
            const totalPriceSpan = document.querySelector('.total-price');
            const priceSpan = document.querySelector('.price');
            
            const roomPrices = {
                '1': 150000,
                '2': 250000,
                '3': 400000,
                '4': 300000
            };
            
            function calculateNights() {
                const checkIn = new Date(fechaEntradaInput.value);
                const checkOut = new Date(fechaSalidaInput.value);
                
                if (checkIn && checkOut && checkIn < checkOut) {
                    const timeDiff = checkOut.getTime() - checkIn.getTime();
                    const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
                    nightsSpan.textContent = nights;
                    return nights;
                } else {
                    nightsSpan.textContent = '0';
                    return 0;
                }
            }
            
            function calculateTotalPrice() {
                const nights = calculateNights();
                const roomType = tipoHabitacionSelect.value;
                const pricePerNight = roomPrices[roomType] || 0;
                const total = nights * pricePerNight;
                
                totalPriceSpan.textContent = `$${total.toLocaleString('es-CO')}`;
                return total;
            }
            
            if (fechaEntradaInput) {
                fechaEntradaInput.addEventListener('change', calculateTotalPrice);
            }
            
            if (fechaSalidaInput) {
                fechaSalidaInput.addEventListener('change', calculateTotalPrice);
            }
            
            if (tipoHabitacionSelect) {
                tipoHabitacionSelect.addEventListener('change', function() {
                    const roomType = tipoHabitacionSelect.value;
                    const pricePerNight = roomPrices[roomType] || 0;
                    if (priceSpan) {
                        priceSpan.textContent = `$${pricePerNight.toLocaleString('es-CO')}`;
                    }
                    calculateTotalPrice();
                });
            }
            
            const reservationForm = document.querySelector('.reservation-form');
            if (reservationForm) {
                reservationForm.addEventListener('submit', function(e) {
                    // Validar que todos los campos requeridos estén completos
                    const requiredFields = reservationForm.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.style.borderColor = '#e74c3c';
                        } else {
                            field.style.borderColor = '#e9ecef';
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        alert('Por favor, completa todos los campos requeridos.');
                        return;
                    }
                    
                    // Si todo está válido, permitir el envío del formulario
                    console.log('Formulario enviado a create.php');
                });
            }
            
            if (fechaEntradaInput) {
                const today = new Date().toISOString().split('T')[0];
                fechaEntradaInput.min = today;
            }
            
            console.log('JavaScript inicializado correctamente');
        });
    </script>
</body>
</html>