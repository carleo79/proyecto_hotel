<?php
require_once '../libreria/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_producto = mysqli_real_escape_string($conn, $_POST['codigo_producto']);
    $nombre_producto = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $id_categoria = !empty($_POST['id_categoria']) ? intval($_POST['id_categoria']) : 'NULL';
    $id_proveedor = !empty($_POST['id_proveedor']) ? intval($_POST['id_proveedor']) : 'NULL';
    $unidad_medida = mysqli_real_escape_string($conn, $_POST['unidad_medida']);
    $precio_unitario = !empty($_POST['precio_unitario']) ? floatval($_POST['precio_unitario']) : 'NULL';
    $costo_unitario = !empty($_POST['costo_unitario']) ? floatval($_POST['costo_unitario']) : 'NULL';
    $ubicacion = mysqli_real_escape_string($conn, $_POST['ubicacion']);
    $estado = mysqli_real_escape_string($conn, $_POST['estado']);
    $cantidad_disponible = !empty($_POST['cantidad_disponible']) ? intval($_POST['cantidad_disponible']) : 0;

    // Validar si el código ya existe
    $check = mysqli_query($conn, "SELECT 1 FROM productos WHERE codigo_producto = '$codigo_producto'");
    if (mysqli_num_rows($check) > 0) {
        $mensaje_error = base64_encode("<div class='alert alert-danger'>El código de producto ya existe. Por favor, elige otro.</div>");
        header('Location: index.php?error=' . $mensaje_error);
        exit;
    } else {
        $sql = "INSERT INTO productos (codigo_producto, nombre_producto, descripcion, id_categoria, id_proveedor, unidad_medida, precio_unitario, costo_unitario, ubicacion, estado) VALUES ('$codigo_producto', '$nombre_producto', '$descripcion', $id_categoria, $id_proveedor, '$unidad_medida', $precio_unitario, $costo_unitario, '$ubicacion', '$estado')";
        if (mysqli_query($conn, $sql)) {
            $id_producto = mysqli_insert_id($conn);
            
            // Insertar en la tabla inventario
            $sql_inventario = "INSERT INTO inventario (id_producto, cantidad_disponible, fecha_ingreso, fecha_actualizacion) VALUES ($id_producto, $cantidad_disponible, CURDATE(), CURDATE())";
            
            if (mysqli_query($conn, $sql_inventario)) {
                header('Location: index.php?mensaje=Producto registrado exitosamente');
            } else {
                // Si falla la inserción en inventario, eliminar el producto
                mysqli_query($conn, "DELETE FROM productos WHERE id_producto = $id_producto");
                $mensaje_error = base64_encode("<div class='alert alert-danger'>Error al registrar inventario: " . mysqli_error($conn) . "</div>");
                header('Location: index.php?error=' . $mensaje_error);
            }
        } else {
            $mensaje_error = base64_encode("<div class='alert alert-danger'>Error al registrar: " . mysqli_error($conn) . "</div>");
            header('Location: index.php?error=' . $mensaje_error);
        }
        exit;
    }
}
mysqli_close($conn);
?> 