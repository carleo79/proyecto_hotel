<?php
require_once '../libreria/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_categoria = mysqli_real_escape_string($conn, $_POST['nombre_categoria']);
    // Validar si el nombre ya existe
    $check = mysqli_query($conn, "SELECT 1 FROM categorias WHERE nombre_categoria = '$nombre_categoria'");
    if (mysqli_num_rows($check) > 0) {
        $mensaje_error = base64_encode("<div class='alert alert-danger'>El nombre de la categoría ya existe. Por favor, elige otro.</div>");
        header('Location: index.php?error=' . $mensaje_error);
        exit;
    } else {
        $sql = "INSERT INTO categorias (nombre_categoria) VALUES ('$nombre_categoria')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?mensaje=Categoría registrada exitosamente');
        } else {
            $mensaje_error = base64_encode("<div class='alert alert-danger'>Error al registrar: " . mysqli_error($conn) . "</div>");
            header('Location: index.php?error=' . $mensaje_error);
        }
        exit;
    }
}
mysqli_close($conn);
?> 