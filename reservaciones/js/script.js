//JAVASCRIPT

// Validar el formulario antes de enviar
function validarFormulario() {
    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const apellido = document.querySelector('input[name="apellido"]').value.trim();
    const fechaEntrada = document.querySelector('input[name="fecha_entrada"]').value;
    const fechaSalida = document.querySelector('input[name="fecha_salida"]').value;
    const adultos = document.querySelector('input[name="adultos"]').value.trim();
    const kids = document.querySelector('input[name="kids"]').value.trim();
    const tipoHabitacion = document.querySelector('select[name="tipo_habitacion"]').value;

    if (!nombre || !apellido || !fechaEntrada || !fechaSalida || !adultos || !tipoHabitacion) {
        alert("Por favor, completa todos los campos requeridos.");
        return false;
    }

    if (isNaN(adultos) || adultos < 1 || adultos > 10) {
        alert("El número de adultos debe ser entre 1 y 10.");
        return false;
    }

    if (isNaN(kids) || kids < 0 || kids > 10) {
        alert("El número de niños debe ser entre 0 y 10.");
        return false;
    }

    if (new Date(fechaEntrada) >= new Date(fechaSalida)) {
        alert("La fecha de entrada debe ser anterior a la fecha de salida.");
        return false;
    }

    return true;
}

// Confirmación antes de eliminar una reservación
function eliminarReservacion(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta reservación?")) {
        window.location.href = `delete.php?delete_id=${id}`;
    }
}

// Mostrar el formulario de actualización con los datos cargados
function mostrarFormularioActualizar(id, nombre, apellido, fecha_entrada, fecha_salida, adultos, kids, tipo_habitacion) {
    const formActualizar = document.createElement('div');
    formActualizar.style.cssText = `
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 20px;
        border: 2px solid #e7b85c;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        z-index: 1000;
        max-width: 400px;
        width: 90%;
    `;
    
    formActualizar.innerHTML = `
        <h3>Actualizar Reservación</h3>
        <form action="update.php" method="POST">
            <input type="hidden" name="update_id" value="${id}">
            <input type="text" name="update_nombre" value="${nombre}" placeholder="Nombre" required>
            <input type="text" name="update_apellido" value="${apellido}" placeholder="Apellido" required>
            <input type="date" name="update_fecha_entrada" value="${fecha_entrada}" required>
            <input type="date" name="update_fecha_salida" value="${fecha_salida}" required>
            <input type="number" name="update_adultos" value="${adultos}" placeholder="Adultos" min="1" max="10" required>
            <input type="number" name="update_kids" value="${kids}" placeholder="Niños" min="0" max="10" required>
            <select name="update_tipo_habitacion" required>
                <option value="">Seleccionar Tipo</option>
                <option value="1" ${tipo_habitacion == 1 ? 'selected' : ''}>Habitación Estándar</option>
                <option value="2" ${tipo_habitacion == 2 ? 'selected' : ''}>Habitación Deluxe</option>
                <option value="3" ${tipo_habitacion == 3 ? 'selected' : ''}>Suite</option>
                <option value="4" ${tipo_habitacion == 4 ? 'selected' : ''}>Habitación Familiar</option>
            </select>
            <button type="submit" name="update">Actualizar</button>
            <button type="button" onclick="cerrarFormularioActualizar()">Cancelar</button>
        </form>
    `;

    document.body.appendChild(formActualizar);
}

// Cerrar el formulario de actualización
function cerrarFormularioActualizar() {
    const formActualizar = document.querySelector('div[style*="position: fixed"]');
    if (formActualizar) {
        formActualizar.remove();
    }
}
