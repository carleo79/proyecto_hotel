<?php
require_once '../libreria/db.php';
if (isset($_GET['id_proveedor'])) {
    $id_proveedor = intval($_GET['id_proveedor']);
    $sql = "DELETE FROM proveedores WHERE id_proveedor = $id_proveedor";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Proveedor eliminado exitosamente');
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?> 