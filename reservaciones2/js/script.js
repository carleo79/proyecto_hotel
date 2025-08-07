// JavaScript para gestión de reservaciones - Solo inserción

// Validar el formulario antes de enviar
function validarFormulario() {
    const fecha_entrada = document.querySelector('input[name="fecha_entrada"]').value.trim();
    const fecha_salida = document.querySelector('input[name="fecha_salida"]').value.trim();
    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const apellido = document.querySelector('input[name="apellido"]').value.trim();
    const adultos = document.querySelector('select[name="adultos"]').value.trim();
    const kids = document.querySelector('select[name="kids"]').value.trim();
    const tipo_habitacion = document.querySelector('select[name="tipo_habitacion"]').value.trim();

    // Validar campos requeridos
    if (!fecha_entrada || !fecha_salida || !nombre || !apellido || !adultos || !tipo_habitacion) {
        mostrarAlerta('Por favor, completa todos los campos requeridos.', 'error');
        return false;
    }

    // Validar fechas
    if (new Date(fecha_entrada) >= new Date(fecha_salida)) {
        mostrarAlerta('La fecha de entrada debe ser anterior a la fecha de salida.', 'error');
        return false;
    }

    // Validar que la fecha de entrada no sea anterior a hoy
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    if (new Date(fecha_entrada) < today) {
        mostrarAlerta('La fecha de entrada no puede ser anterior a hoy.', 'error');
        return false;
    }

    return true;
}

// Mostrar alerta personalizada
function mostrarAlerta(mensaje, tipo) {
    // Remover alertas existentes
    const alertasExistentes = document.querySelectorAll('.alert');
    alertasExistentes.forEach(alerta => alerta.remove());

    const alerta = document.createElement('div');
    alerta.className = `alert ${tipo}`;
    alerta.textContent = mensaje;
    
    // Insertar después del título
    const container = document.querySelector('.container');
    const titulo = container.querySelector('h2');
    container.insertBefore(alerta, titulo.nextSibling);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        if (alerta.parentNode) {
            alerta.remove();
        }
    }, 5000);
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript de reservaciones2 cargado correctamente');
    
    // Establecer fecha mínima para campos de fecha
    const fechaInputs = document.querySelectorAll('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    fechaInputs.forEach(input => {
        input.setAttribute('min', today);
    });
    
    console.log('Formulario de inserción de reservaciones inicializado');
});
