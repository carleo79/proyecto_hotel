<?php
require 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM reservacion2 WHERE id_reservacion = $delete_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: index.php?mensaje=¡Reservación eliminada exitosamente!");
        exit;
    } else {
        header("Location: index.php?error=Error al eliminar la reservación");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>