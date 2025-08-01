<?php
require_once '../libreria/db.php';
if (isset($_GET['id_proveedor'])) {
    $id_proveedor = intval($_GET['id_proveedor']);
    $sql = "SELECT * FROM proveedores WHERE id_proveedor = $id_proveedor";
    $result = mysqli_query($conn, $sql);
    $proveedor = mysqli_fetch_assoc($result);
}
$mensaje_error = '';
if (isset($_POST['update'])) {
    $id_proveedor = intval($_POST['id_proveedor']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $contacto = mysqli_real_escape_string($conn, $_POST['contacto']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    // Validar si el nombre ya existe en otro proveedor
    $check = mysqli_query($conn, "SELECT 1 FROM proveedores WHERE nombre = '$nombre' AND id_proveedor != $id_proveedor");
    if (mysqli_num_rows($check) > 0) {
        $mensaje_error = "<div class='alert alert-danger'>El nombre del proveedor ya existe. Por favor, elige otro.</div>";
    } else {
        $sql = "UPDATE proveedores SET nombre='$nombre', contacto='$contacto', direccion='$direccion' WHERE id_proveedor=$id_proveedor";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?mensaje=Proveedor actualizado exitosamente');
        } else {
            $mensaje_error = "<div class='alert alert-danger'>Error al actualizar: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Proveedor</h2>
    <?php if (!empty($mensaje_error)) echo $mensaje_error; ?>
    <form action="update.php" method="POST" class="row g-3">
        <input type="hidden" name="id_proveedor" value="<?php echo $proveedor['id_proveedor']; ?>">
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $proveedor['nombre']; ?>" required>
        </div>
        <div class="col-md-4">
            <label for="contacto" class="form-label">Contacto</label>
            <input type="text" id="contacto" name="contacto" class="form-control" value="<?php echo $proveedor['contacto']; ?>">
        </div>
        <div class="col-md-4">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $proveedor['direccion']; ?>">
        </div>
        <div class="col-12">
            <button type="submit" name="update" class="btn btn-success">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 