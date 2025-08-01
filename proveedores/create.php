<?php
require_once '../libreria/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $contacto = mysqli_real_escape_string($conn, $_POST['contacto']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    // Validar si el nombre ya existe
    $check = mysqli_query($conn, "SELECT 1 FROM proveedores WHERE nombre = '$nombre'");
    if (mysqli_num_rows($check) > 0) {
        $mensaje_error = base64_encode("<div class='alert alert-danger'>El nombre del proveedor ya existe. Por favor, elige otro.</div>");
        header('Location: index.php?error=' . $mensaje_error);
        exit;
    } else {
        $sql = "INSERT INTO proveedores (nombre, contacto, direccion) VALUES ('$nombre', '$contacto', '$direccion')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?mensaje=Proveedor registrado exitosamente');
        } else {
            $mensaje_error = base64_encode("<div class='alert alert-danger'>Error al registrar: " . mysqli_error($conn) . "</div>");
            header('Location: index.php?error=' . $mensaje_error);
        }
        exit;
    }
}
mysqli_close($conn);
?> 