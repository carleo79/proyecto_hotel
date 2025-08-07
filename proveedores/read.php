<?php
require_once '../libreria/db.php';
$sql = "SELECT * FROM proveedores";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_proveedor'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['contacto'] . "</td>";
        echo "<td>" . $row['direccion'] . "</td>";
        echo '<td>
                <div class="btn-group">
                    <button class="edit-btn" onclick="mostrarFormularioActualizar(' . $row['id_proveedor'] . ', \'' . addslashes($row['nombre']) . '\', \'' . addslashes($row['contacto']) . '\', \'' . addslashes($row['direccion']) . '\')">Editar</button>
                    <button class="delete-btn" onclick="eliminarProveedor(' . $row['id_proveedor'] . ')">Eliminar</button>
                </div>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay proveedores registrados.</td></tr>";
}
mysqli_close($conn);
?> 