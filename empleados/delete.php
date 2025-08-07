//delete.php
<?php
require 'db.php';

if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $delete_query = "DELETE FROM empleados WHERE id = $delete_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: index.php?mensaje=¡Empleado eliminado exitosamente!");
        exit();
    } else {
        echo "Error al eliminar el empleado: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php?mensaje=ID de empleado no proporcionado");
    exit();
}

mysqli_close($conn);
?>