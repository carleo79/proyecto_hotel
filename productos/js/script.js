// JavaScript para gestión de productos

// Validar el formulario antes de enviar
function validarFormulario() {
    const nombre_producto = document.querySelector('input[name="nombre_producto"]').value.trim();
    const descripcion = document.querySelector('input[name="descripcion"]').value.trim();
    const precio_unitario = document.querySelector('input[name="precio_unitario"]').value.trim();
    const cantidad_disponible = document.querySelector('input[name="cantidad_disponible"]').value.trim();

    // Validar campos requeridos
    if (!nombre_producto || !descripcion || !precio_unitario || !cantidad_disponible) {
        mostrarAlerta('Por favor, completa todos los campos.', 'error');
        return false;
    }

    // Validar precio
    if (isNaN(precio_unitario) || parseFloat(precio_unitario) <= 0) {
        mostrarAlerta('El precio debe ser un número positivo.', 'error');
        return false;
    }

    // Validar cantidad
    if (isNaN(cantidad_disponible) || parseInt(cantidad_disponible) < 0) {
        mostrarAlerta('La cantidad debe ser un número entero no negativo.', 'error');
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

// Confirmación antes de eliminar un producto
function eliminarProducto(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        window.location.href = `delete.php?id_producto=${id}`;
    }
}



// Mostrar el formulario de actualización en el formulario existente
function mostrarFormularioActualizar(id, nombre_producto, descripcion, precio_unitario, cantidad_disponible) {
    const form = document.querySelector('.product-form');
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
    const nombreInput = form.querySelector('input[name="nombre_producto"]');
    const descripcionInput = form.querySelector('input[name="descripcion"]');
    const precioInput = form.querySelector('input[name="precio_unitario"]');
    const cantidadInput = form.querySelector('input[name="cantidad_disponible"]');
    
    nombreInput.value = nombre_producto;
    descripcionInput.value = descripcion;
    precioInput.value = precio_unitario;
    cantidadInput.value = cantidad_disponible;
    
    // Cambiar el texto del botón
    const btnSpan = submitBtn.querySelector('span');
    const btnSmall = submitBtn.querySelector('small');
    
    btnSpan.textContent = 'Actualizar Producto';
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
    mostrarAlerta('Modo edición activado. Los cambios se guardarán al hacer clic en "Actualizar Producto".', 'success');
}

// Cancelar la edición y volver al modo crear
function cancelarEdicion() {
    const form = document.querySelector('.product-form');
    const submitBtn = document.querySelector('.submit-btn');
    
    // Restaurar la acción del formulario
    form.action = 'create.php';
    
    // Remover campo hidden
    const hiddenInput = form.querySelector('input[name="update_id"]');
    if (hiddenInput) {
        hiddenInput.remove();
    }
    
    // Limpiar los campos
    const nombreInput = form.querySelector('input[name="nombre_producto"]');
    const descripcionInput = form.querySelector('input[name="descripcion"]');
    const precioInput = form.querySelector('input[name="precio_unitario"]');
    const cantidadInput = form.querySelector('input[name="cantidad_disponible"]');
    
    nombreInput.value = '';
    descripcionInput.value = '';
    precioInput.value = '';
    cantidadInput.value = '';
    
    // Restaurar el texto del botón
    const btnSpan = submitBtn.querySelector('span');
    const btnSmall = submitBtn.querySelector('small');
    
    btnSpan.textContent = 'Registrar Producto';
    btnSmall.textContent = 'Guardar información del producto';
    
    // Restaurar el color del botón
    submitBtn.style.background = 'linear-gradient(135deg, #e7b85c 0%, #f4d03f 100%)';
    submitBtn.style.boxShadow = '0 6px 20px rgba(231, 184, 92, 0.3)';
    
    // Remover botón de cancelar
    const cancelBtn = document.querySelector('.cancel-btn');
    if (cancelBtn) {
        cancelBtn.remove();
    }
    
    // Mostrar mensaje de cancelación
    mostrarAlerta('Modo crear restaurado. Puedes crear un nuevo producto.', 'success');
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript de productos cargado correctamente');
}); 