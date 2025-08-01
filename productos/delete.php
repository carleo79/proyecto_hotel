<?php
require_once '../libreria/db.php';
if (isset($_GET['id_producto'])) {
    $id_producto = intval($_GET['id_producto']);
    $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Producto eliminado exitosamente');
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?> 