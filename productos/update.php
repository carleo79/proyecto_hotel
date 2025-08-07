<?php
require_once '../libreria/db.php';

if (isset($_POST['update_id'])) {
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $update_nombre_producto = mysqli_real_escape_string($conn, $_POST['nombre_producto']);
    $update_descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $update_precio_unitario = mysqli_real_escape_string($conn, $_POST['precio_unitario']);
    $update_cantidad_disponible = mysqli_real_escape_string($conn, $_POST['cantidad_disponible']);
    
    // Actualizar la tabla productos
    $sql = "UPDATE productos SET 
            nombre_producto='$update_nombre_producto', 
            descripcion='$update_descripcion', 
            precio_unitario='$update_precio_unitario' 
            WHERE id_producto='$update_id'";
    
    if (mysqli_query($conn, $sql)) {
        // Actualizar la cantidad en la tabla inventario
        $sql_inventario = "UPDATE inventario SET 
                          cantidad_disponible='$update_cantidad_disponible',
                          fecha_actualizacion=CURDATE()
                          WHERE id_producto='$update_id'";
        
        if (mysqli_query($conn, $sql_inventario)) {
            header('Location: index.php?mensaje=Producto actualizado exitosamente');
        } else {
            header('Location: index.php?mensaje=Error al actualizar inventario: ' . mysqli_error($conn));
        }
    } else {
        header('Location: index.php?mensaje=Error al actualizar producto: ' . mysqli_error($conn));
    }
    exit;
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Producto</h2>
    <?php if (!empty($mensaje_error)) echo $mensaje_error; ?>
    <form action="update.php" method="POST" class="row g-3">
        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
        <div class="col-md-4">
            <label for="codigo_producto" class="form-label">Código</label>
            <input type="text" id="codigo_producto" name="codigo_producto" class="form-control" value="<?php echo $producto['codigo_producto']; ?>" required>
        </div>
        <div class="col-md-4">
            <label for="nombre_producto" class="form-label">Nombre</label>
            <input type="text" id="nombre_producto" name="nombre_producto" class="form-control" value="<?php echo $producto['nombre_producto']; ?>" required>
        </div>
        <div class="col-md-4">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $producto['descripcion']; ?>">
        </div>
        <div class="col-md-4">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select id="id_categoria" name="id_categoria" class="form-select">
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?php echo $cat['id_categoria']; ?>" <?php if ($producto['id_categoria'] == $cat['id_categoria']) echo 'selected'; ?>><?php echo $cat['id_categoria'] . ' - ' . $cat['nombre_categoria']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="id_proveedor" class="form-label">Proveedor</label>
            <select id="id_proveedor" name="id_proveedor" class="form-select">
                <option value="">Seleccione un proveedor</option>
                <?php foreach ($proveedores as $prov): ?>
                    <option value="<?php echo $prov['id_proveedor']; ?>" <?php if ($producto['id_proveedor'] == $prov['id_proveedor']) echo 'selected'; ?>><?php echo $prov['id_proveedor'] . ' - ' . $prov['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
            <input type="text" id="unidad_medida" name="unidad_medida" class="form-control" value="<?php echo $producto['unidad_medida']; ?>">
        </div>
        <div class="col-md-4">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" class="form-control" value="<?php echo $producto['precio_unitario']; ?>">
        </div>
        <div class="col-md-4">
            <label for="costo_unitario" class="form-label">Costo Unitario</label>
            <input type="number" step="0.01" id="costo_unitario" name="costo_unitario" class="form-control" value="<?php echo $producto['costo_unitario']; ?>">
        </div>
        <div class="col-md-4">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="<?php echo $producto['ubicacion']; ?>">
        </div>
        <div class="col-md-4">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $producto['estado']; ?>">
        </div>
        <div class="col-md-4">
            <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
            <input type="number" id="cantidad_disponible" name="cantidad_disponible" class="form-control" value="<?php echo $producto['cantidad_disponible']; ?>">
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