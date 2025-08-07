<?php
require_once '../libreria/db.php';

if (isset($_POST['update_id'])) {
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $update_nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $update_contacto = mysqli_real_escape_string($conn, $_POST['contacto']);
    $update_direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    
    $sql = "UPDATE proveedores SET 
            nombre='$update_nombre', 
            contacto='$update_contacto', 
            direccion='$update_direccion' 
            WHERE id_proveedor='$update_id'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Proveedor actualizado exitosamente');
    } else {
        header('Location: index.php?mensaje=Error al actualizar: ' . mysqli_error($conn));
    }
    exit;
}

mysqli_close($conn);
?> 