// JavaScript para gestión de proveedores

// Validar el formulario antes de enviar
function validarFormulario() {
    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const contacto = document.querySelector('input[name="contacto"]').value.trim();
    const direccion = document.querySelector('input[name="direccion"]').value.trim();

    // Validar campos requeridos
    if (!nombre || !contacto || !direccion) {
        mostrarAlerta('Por favor, completa todos los campos.', 'error');
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

// Confirmación antes de eliminar un proveedor
function eliminarProveedor(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
        window.location.href = `delete.php?id_proveedor=${id}`;
    }
}



// Mostrar el formulario de actualización en el formulario existente
function mostrarFormularioActualizar(id, nombre, contacto, direccion) {
    const form = document.querySelector('.provider-form');
    const submitBtn = document.querySelector('.submit-btn');
    
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
    const contactoInput = form.querySelector('input[name="contacto"]');
    const direccionInput = form.querySelector('input[name="direccion"]');
    
    nombreInput.value = nombre;
    contactoInput.value = contacto;
    direccionInput.value = direccion;
    
    // Cambiar el texto del botón
    const btnSpan = submitBtn.querySelector('span');
    const btnSmall = submitBtn.querySelector('small');
    
    btnSpan.textContent = 'Actualizar Proveedor';
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
    mostrarAlerta('Modo edición activado. Los cambios se guardarán al hacer clic en "Actualizar Proveedor".', 'success');
}

// Cancelar la edición y volver al modo crear
function cancelarEdicion() {
    const form = document.querySelector('.provider-form');
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
    const contactoInput = form.querySelector('input[name="contacto"]');
    const direccionInput = form.querySelector('input[name="direccion"]');
    
    nombreInput.value = '';
    contactoInput.value = '';
    direccionInput.value = '';
    
    // Restaurar el texto del botón
    const btnSpan = submitBtn.querySelector('span');
    const btnSmall = submitBtn.querySelector('small');
    
    btnSpan.textContent = 'Registrar Proveedor';
    btnSmall.textContent = 'Guardar información del proveedor';
    
    // Restaurar el color del botón
    submitBtn.style.background = 'linear-gradient(135deg, #e7b85c 0%, #f4d03f 100%)';
    submitBtn.style.boxShadow = '0 6px 20px rgba(231, 184, 92, 0.3)';
    
    // Remover botón de cancelar
    const cancelBtn = document.querySelector('.cancel-btn');
    if (cancelBtn) {
        cancelBtn.remove();
    }
    
    // Mostrar mensaje de cancelación
    mostrarAlerta('Modo crear restaurado. Puedes crear un nuevo proveedor.', 'success');
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript de proveedores cargado correctamente');
}); 