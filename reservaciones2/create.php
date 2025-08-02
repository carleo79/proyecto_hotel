<?php
// Archivo: create.php
require 'db.php'; // Incluir conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizar los datos del formulario
    $fecha_entrada = $_POST['fecha_entrada'];
    $fecha_salida = $_POST['fecha_salida'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
    $adultos = intval($_POST['adultos']);
    $kids = intval($_POST['kids']);
    $tipo_habitacion = intval($_POST['tipo_habitacion']);

    // Consulta SQL para insertar los datos en la tabla reservacion2
    $sql = "INSERT INTO reservacion2 (fecha_entrada, fecha_salida, nombre, apellido, adultos, kids, tipo_habitacion) 
            VALUES ('$fecha_entrada', '$fecha_salida', '$nombre', '$apellido', $adultos, $kids, $tipo_habitacion)";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?mensaje=Reservación registrada exitosamente');
        exit;
    } else {
        header('Location: index.php?error=Error al registrar la reservación');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}

// Cerrar la conexión
mysqli_close($conn);
?>