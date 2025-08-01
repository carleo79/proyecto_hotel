// JavaScript simplificado para el formulario de reservas

document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript cargado correctamente');
    
    // Elementos del formulario
    const checkInInput = document.getElementById('checkIn');
    const checkOutInput = document.getElementById('checkOut');
    const roomTypeSelect = document.getElementById('roomType');
    const nightsSpan = document.getElementById('nights');
    const totalPriceSpan = document.querySelector('.total-price');
    const priceSpan = document.querySelector('.price');
    
    // Precios por tipo de habitación
    const roomPrices = {
        'standard': 150000,
        'deluxe': 250000,
        'suite': 400000,
        'family': 300000
    };
    
    // Función para calcular noches
    function calculateNights() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        
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
    
    // Función para calcular precio total
    function calculateTotalPrice() {
        const nights = calculateNights();
        const roomType = roomTypeSelect.value;
        const pricePerNight = roomPrices[roomType] || 0;
        const total = nights * pricePerNight;
        
        totalPriceSpan.textContent = `$${total.toLocaleString('es-CO')}`;
        return total;
    }
    
    // Event listeners para actualizar cálculos
    if (checkInInput) {
        checkInInput.addEventListener('change', calculateTotalPrice);
    }
    
    if (checkOutInput) {
        checkOutInput.addEventListener('change', calculateTotalPrice);
    }
    
    if (roomTypeSelect) {
        roomTypeSelect.addEventListener('change', function() {
            const roomType = roomTypeSelect.value;
            const pricePerNight = roomPrices[roomType] || 0;
            if (priceSpan) {
                priceSpan.textContent = `$${pricePerNight.toLocaleString('es-CO')}`;
            }
            calculateTotalPrice();
        });
    }
    
    // Manejar envío del formulario
    const reservationForm = document.querySelector('.reservation-form');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('¡Formulario enviado correctamente!');
        });
    }
    
    // Establecer fecha mínima para check-in (hoy)
    if (checkInInput) {
        const today = new Date().toISOString().split('T')[0];
        checkInInput.min = today;
    }
    
    console.log('JavaScript inicializado correctamente');
});
