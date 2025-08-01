<?php
require_once '../libreria/db.php';
// Obtener categorías
$categorias = [];
$res_cat = mysqli_query($conn, "SELECT id_categoria, nombre_categoria FROM categorias");
if ($res_cat) {
    while ($cat = mysqli_fetch_assoc($res_cat)) {
        $categorias[] = $cat;
    }
}
// Obtener proveedores
$proveedores = [];
$res_prov = mysqli_query($conn, "SELECT id_proveedor, nombre FROM proveedores");
if ($res_prov) {
    while ($prov = mysqli_fetch_assoc($res_prov)) {
        $proveedores[] = $prov;
    }
}
if (isset($_GET['id_producto'])) {
    $id_producto = intval($_GET['id_producto']);
    $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
    $result = mysqli_query($conn, $sql);
    $producto = mysqli_fetch_assoc($result);
}
// Variable para mensaje de error
$mensaje_error = '';
if (isset($_POST['update'])) {
    $id_producto = intval($_POST['id_producto']);
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
    // Validar si el código ya existe en otro producto
    $check = mysqli_query($conn, "SELECT 1 FROM productos WHERE codigo_producto = '$codigo_producto' AND id_producto != $id_producto");
    if (mysqli_num_rows($check) > 0) {
        $mensaje_error = "<div class='alert alert-danger'>El código de producto ya existe. Por favor, elige otro.</div>";
    } else {
        $sql = "UPDATE productos SET codigo_producto='$codigo_producto', nombre_producto='$nombre_producto', descripcion='$descripcion', id_categoria=$id_categoria, id_proveedor=$id_proveedor, unidad_medida='$unidad_medida', precio_unitario=$precio_unitario, costo_unitario=$costo_unitario, ubicacion='$ubicacion', estado='$estado' WHERE id_producto=$id_producto";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php?mensaje=Producto actualizado exitosamente');
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
        <div class="col-12">
            <button type="submit" name="update" class="btn btn-success">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 