<?php
require_once '../libreria/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    
    // Validar si el nombre ya existe
    $check = mysqli_query($conn, "SELECT 1 FROM categorias WHERE nombre_categoria = '$nombre'");
    if (mysqli_num_rows($check) > 0) {
        header('Location: index.php?mensaje=El nombre de la categoría ya existe. Por favor, elige otro.');
        exit;
    } else {
        $sql = "INSERT INTO categorias (nombre_categoria, descripcion) VALUES ('$nombre', '$descripcion')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?mensaje=Categoría registrada exitosamente');
        } else {
            header('Location: index.php?mensaje=Error al registrar: ' . mysqli_error($conn));
        }
        exit;
    }
}
mysqli_close($conn);
?> 