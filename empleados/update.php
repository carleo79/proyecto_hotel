<?php
require_once '../libreria/db.php';

if (isset($_POST['update_id'])) {
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $update_nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $update_apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
    $update_telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $update_correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $update_fecha_entrada = mysqli_real_escape_string($conn, $_POST['fecha_entrada']);
    $update_fecha_salida = mysqli_real_escape_string($conn, $_POST['fecha_salida']);
    $update_salario = mysqli_real_escape_string($conn, $_POST['salario']);
    
    $sql = "UPDATE empleados SET 
            nombre='$update_nombre', 
            apellido='$update_apellido', 
            telefono='$update_telefono', 
            correo='$update_correo', 
            fecha_entrada='$update_fecha_entrada', 
            fecha_salida='$update_fecha_salida', 
            salario='$update_salario' 
            WHERE id='$update_id'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Empleado actualizado exitosamente');
    } else {
        header('Location: index.php?mensaje=Error al actualizar: ' . mysqli_error($conn));
    }
    exit;
}

mysqli_close($conn);
?>