// JavaScript para gestión de reservaciones

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

// Confirmación antes de eliminar una reservación
function eliminarReservacion(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta reservación?")) {
        window.location.href = `delete.php?id_reservacion=${id}`;
    }
}

// Mostrar el formulario de actualización en el formulario existente
function mostrarFormularioActualizar(id, nombre, apellido, fecha_entrada, fecha_salida, adultos, kids, tipo_habitacion) {
    console.log('Función mostrarFormularioActualizar llamada con ID:', id);
    
    const form = document.querySelector('.reservation-form');
    const submitBtn = document.querySelector('.submit-btn');
    
    if (!form) {
        console.error('No se encontró el formulario con clase reservation-form');
        return;
    }
    
    if (!submitBtn) {
        console.error('No se encontró el botón submit con clase submit-btn');
        return;
    }
    
    console.log('Formulario y botón encontrados correctamente');
    
    // Cambiar la acción del formulario
    form.action = 'update.php';
    
    // Agregar campo hidden para el ID
    let hiddenInput = form.querySelector('input[name="update_id"]');
    if (!hiddenInput) {
        hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'update_id';
        form.appendChild(hiddenInput);
    }
    hiddenInput.value = id;
    
    // Actualizar los valores de los campos
    const nombreInput = form.querySelector('input[name="nombre"]');
    const apellidoInput = form.querySelector('input[name="apellido"]');
    const fechaEntradaInput = form.querySelector('input[name="fecha_entrada"]');
    const fechaSalidaInput = form.querySelector('input[name="fecha_salida"]');
    const adultosInput = form.querySelector('select[name="adultos"]');
    const kidsInput = form.querySelector('select[name="kids"]');
    const tipoHabitacionInput = form.querySelector('select[name="tipo_habitacion"]');
    
    nombreInput.value = nombre;
    apellidoInput.value = apellido;
    fechaEntradaInput.value = fecha_entrada;
    fechaSalidaInput.value = fecha_salida;
    adultosInput.value = adultos;
    kidsInput.value = kids;
    tipoHabitacionInput.value = tipo_habitacion;
    
    // Cambiar el texto del botón
    const btnSpan = submitBtn.querySelector('span');
    const btnSmall = submitBtn.querySelector('small');
    
    btnSpan.textContent = 'Actualizar Reservación';
    btnSmall.textContent = 'Guardar cambios realizados';
    
    // Cambiar el color del botón para indicar modo edición
    submitBtn.style.background = 'linear-gradient(135deg, #3498db 0%, #2980b9 100%)';
    submitBtn.style.boxShadow = '0 6px 20px rgba(52, 152, 219, 0.3)';
    
    // Agregar botón de cancelar
    let cancelBtn = document.querySelector('.cancel-btn');
    if (!cancelBtn) {
        cancelBtn = document.createElement('button');
        cancelBtn.type = 'button';
        cancelBtn.className = 'cancel-btn';
        cancelBtn.innerHTML = `
            <span>Cancelar</span>
            <small>Volver al modo crear</small>
        `;
        cancelBtn.onclick = cancelarEdicion;
        
        // Insertar después del botón de submit
        submitBtn.parentNode.insertBefore(cancelBtn, submitBtn.nextSibling);
    }
    
    // Scroll suave hacia el formulario
    form.scrollIntoView({ behavior: 'smooth' });
    
    // Mostrar mensaje de modo edición
    mostrarAlerta('Modo edición activado. Los cambios se guardarán al hacer clic en "Actualizar Reservación".', 'success');
    
    console.log('Formulario actualizado exitosamente');
}

// Cancelar la edición y volver al modo crear
function cancelarEdicion() {
    const form = document.querySelector('.reservation-form');
    const submitBtn = document.querySelector('.submit-btn');
    
    // Restaurar la acción del formulario
    form.action = 'create.php';
    
    // Remover campo hidden
    const hiddenInput = form.querySelector('input[name="update_id"]');
    if (hiddenInput) {
        hiddenInput.remove();
    }
    
    // Limpiar los campos
    const nombreInput = form.querySelector('input[name="nombre"]');
    const apellidoInput = form.querySelector('input[name="apellido"]');
    const fechaEntradaInput = form.querySelector('input[name="fecha_entrada"]');
    const fechaSalidaInput = form.querySelector('input[name="fecha_salida"]');
    const adultosInput = form.querySelector('select[name="adultos"]');
    const kidsInput = form.querySelector('select[name="kids"]');
    const tipoHabitacionInput = form.querySelector('select[name="tipo_habitacion"]');
    
    nombreInput.value = '';
    apellidoInput.value = '';
    fechaEntradaInput.value = '';
    fechaSalidaInput.value = '';
    adultosInput.value = '';
    kidsInput.value = '0';
    tipoHabitacionInput.value = '';
    
    // Restaurar el texto del botón
    const btnSpan = submitBtn.querySelector('span');
    const btnSmall = submitBtn.querySelector('small');
    
    btnSpan.textContent = 'Registrar Reservación';
    btnSmall.textContent = 'Guardar información de la reservación';
    
    // Restaurar el color del botón
    submitBtn.style.background = 'linear-gradient(135deg, #e7b85c 0%, #f4d03f 100%)';
    submitBtn.style.boxShadow = '0 6px 20px rgba(231, 184, 92, 0.3)';
    
    // Remover botón de cancelar
    const cancelBtn = document.querySelector('.cancel-btn');
    if (cancelBtn) {
        cancelBtn.remove();
    }
    
    // Mostrar mensaje de cancelación
    mostrarAlerta('Modo crear restaurado. Puedes crear una nueva reservación.', 'success');
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, inicializando JavaScript de reservaciones');
    
    // Establecer fecha mínima para campos de fecha
    const fechaInputs = document.querySelectorAll('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    fechaInputs.forEach(input => {
        input.setAttribute('min', today);
    });
    
    // Verificar que los elementos principales existen
    const form = document.querySelector('.reservation-form');
    const submitBtn = document.querySelector('.submit-btn');
    
    console.log('Formulario encontrado:', !!form);
    console.log('Botón submit encontrado:', !!submitBtn);
    
    console.log('JavaScript de reservaciones cargado correctamente');
});
