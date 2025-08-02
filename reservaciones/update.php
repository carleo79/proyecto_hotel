//update.php
<?php
require 'db.php';

if (isset($_POST['update'])) {
    $update_id = intval($_POST['update_id']);
    $update_nombre = mysqli_real_escape_string($conn, $_POST['update_nombre']);
    $update_apellido = mysqli_real_escape_string($conn, $_POST['update_apellido']);
    $update_fecha_entrada = $_POST['update_fecha_entrada'];
    $update_fecha_salida = $_POST['update_fecha_salida'];
    $update_adultos = intval($_POST['update_adultos']);
    $update_kids = intval($_POST['update_kids']);
    $update_tipo_habitacion = intval($_POST['update_tipo_habitacion']);

    $update_query = "UPDATE reservacion2 SET 
                    nombre = '$update_nombre', 
                    apellido = '$update_apellido', 
                    fecha_entrada = '$update_fecha_entrada', 
                    fecha_salida = '$update_fecha_salida', 
                    adultos = $update_adultos, 
                    kids = $update_kids, 
                    tipo_habitacion = $update_tipo_habitacion 
                    WHERE id_reservacion = $update_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location: index.php?mensaje=¡Reservación actualizada exitosamente!");
        exit;
    } else {
        header("Location: index.php?error=Error al actualizar la reservación");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>