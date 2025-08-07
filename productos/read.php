<?php
require_once '../libreria/db.php';
$sql = "SELECT p.*, i.cantidad_disponible 
        FROM productos p 
        LEFT JOIN inventario i ON p.id_producto = i.id_producto";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_producto'] . "</td>";
        echo "<td>" . $row['nombre_producto'] . "</td>";
        echo "<td>" . $row['descripcion'] . "</td>";
        echo "<td>\$" . number_format($row['precio_unitario'], 0, ',', '.') . "</td>";
        echo "<td>" . (isset($row['cantidad_disponible']) ? $row['cantidad_disponible'] : '0') . "</td>";
        echo '<td>
                <div class="btn-group">
                    <button class="edit-btn" onclick="mostrarFormularioActualizar(' . $row['id_producto'] . ', \'' . addslashes($row['nombre_producto']) . '\', \'' . addslashes($row['descripcion']) . '\', \'' . $row['precio_unitario'] . '\', \'' . (isset($row['cantidad_disponible']) ? $row['cantidad_disponible'] : '0') . '\')">Editar</button>
                    <button class="delete-btn" onclick="eliminarProducto(' . $row['id_producto'] . ')">Eliminar</button>
                </div>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay productos registrados.</td></tr>";
}
mysqli_close($conn);
?> 