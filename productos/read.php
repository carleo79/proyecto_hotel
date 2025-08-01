<?php
require_once '../libreria/db.php';
$sql = "SELECT p.*, c.nombre_categoria, v.nombre AS nombre_proveedor FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id_categoria
        LEFT JOIN proveedores v ON p.id_proveedor = v.id_proveedor";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_producto'] . "</td>";
        echo "<td>" . $row['codigo_producto'] . "</td>";
        echo "<td>" . $row['nombre_producto'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td>" . ($row['id_categoria'] ? $row['id_categoria'] . ' - ' . $row['nombre_categoria'] : '') . "</td>";
        echo "<td>" . ($row['id_proveedor'] ? $row['id_proveedor'] . ' - ' . $row['nombre_proveedor'] : '') . "</td>";
        echo "<td>" . $row['unidad_medida'] . "</td>";
        echo "<td>" . $row['precio_unitario'] . "</td>";
        echo "<td>" . $row['costo_unitario'] . "</td>";
        echo "<td>" . $row['ubicacion'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo '<td><div class="btn-group" role="group" aria-label="Acciones">'
            . '<a href="update.php?id_producto=' . $row['id_producto'] . '" class="btn btn-sm btn-warning">Editar</a>'
            . '<a href="delete.php?id_producto=' . $row['id_producto'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'¿Seguro que deseas eliminar este producto?\')">Eliminar</a>'
            . '</div></td>';
        echo "</tr>";
    }
}
mysqli_close($conn);
?> 