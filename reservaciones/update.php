<?php
require_once 'db.php';

if (isset($_POST['update_id'])) {
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $update_fecha_entrada = mysqli_real_escape_string($conn, $_POST['fecha_entrada']);
    $update_fecha_salida = mysqli_real_escape_string($conn, $_POST['fecha_salida']);
    $update_nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $update_apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
    $update_adultos = mysqli_real_escape_string($conn, $_POST['adultos']);
    $update_kids = mysqli_real_escape_string($conn, $_POST['kids']);
    $update_tipo_habitacion = mysqli_real_escape_string($conn, $_POST['tipo_habitacion']);
    
    $sql = "UPDATE reservacion2 SET 
            fecha_entrada='$update_fecha_entrada', 
            fecha_salida='$update_fecha_salida', 
            nombre='$update_nombre', 
            apellido='$update_apellido', 
            adultos='$update_adultos', 
            kids='$update_kids', 
            tipo_habitacion='$update_tipo_habitacion' 
            WHERE id_reservacion='$update_id'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Reservación actualizada exitosamente');
    } else {
        header('Location: index.php?mensaje=Error al actualizar: ' . mysqli_error($conn));
    }
    exit;
}

mysqli_close($conn);
?>