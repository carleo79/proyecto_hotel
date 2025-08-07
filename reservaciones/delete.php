<?php
require_once 'db.php';

if (isset($_GET['id_reservacion'])) {
    $id_reservacion = mysqli_real_escape_string($conn, $_GET['id_reservacion']);
    
    $sql = "DELETE FROM reservacion2 WHERE id_reservacion = '$id_reservacion'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Reservación eliminada exitosamente');
    } else {
        header('Location: index.php?mensaje=Error al eliminar: ' . mysqli_error($conn));
    }
} else {
    header('Location: index.php?mensaje=ID de reservación no proporcionado');
}

exit;
mysqli_close($conn);
?>