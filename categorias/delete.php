<?php
require_once '../libreria/db.php';
if (isset($_GET['id_categoria'])) {
    $id_categoria = intval($_GET['id_categoria']);
    $sql = "DELETE FROM categorias WHERE id_categoria = $id_categoria";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Categoría eliminada exitosamente');
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?> 