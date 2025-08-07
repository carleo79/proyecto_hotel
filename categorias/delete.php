<?php
require_once '../libreria/db.php';

if (isset($_GET['id_categoria'])) {
    $id_categoria = mysqli_real_escape_string($conn, $_GET['id_categoria']);
    $sql = "DELETE FROM categorias WHERE id_categoria = '$id_categoria'";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Categoría eliminada exitosamente');
    } else {
        header('Location: index.php?mensaje=Error al eliminar: ' . mysqli_error($conn));
    }
    exit;
} else {
    header('Location: index.php?mensaje=ID de categoría no proporcionado');
    exit;
}

mysqli_close($conn);
?> 