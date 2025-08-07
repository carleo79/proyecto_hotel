<?php
require_once '../libreria/db.php';

if (isset($_POST['update_id'])) {
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $update_nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $update_descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    
    // Validar si el nombre ya existe en otra categoría
    $check = mysqli_query($conn, "SELECT 1 FROM categorias WHERE nombre_categoria = '$update_nombre' AND id_categoria != '$update_id'");
    if (mysqli_num_rows($check) > 0) {
        header('Location: index.php?mensaje=El nombre de la categoría ya existe. Por favor, elige otro.');
        exit;
    } else {
        $sql = "UPDATE categorias SET nombre_categoria='$update_nombre', descripcion='$update_descripcion' WHERE id_categoria='$update_id'";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?mensaje=Categoría actualizada exitosamente');
        } else {
            header('Location: index.php?mensaje=Error al actualizar: ' . mysqli_error($conn));
        }
        exit;
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Categoría</h2>
    <?php if (!empty($mensaje_error)) echo $mensaje_error; ?>
    <form action="update.php" method="POST" class="row g-3">
        <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">
        <div class="col-md-6">
            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
            <input type="text" id="nombre_categoria" name="nombre_categoria" class="form-control" value="<?php echo $categoria['nombre_categoria']; ?>" required>
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