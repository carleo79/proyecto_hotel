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
        echo '<td><div class="btn-group" role="group" aria-label="Acciones">'
            . '<a href="update.php?id_proveedor=' . $row['id_proveedor'] . '" class="btn btn-sm btn-warning">Editar</a>'
            . '<a href="delete.php?id_proveedor=' . $row['id_proveedor'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'¿Seguro que deseas eliminar este proveedor?\')">Eliminar</a>'
            . '</div></td>';
        echo "</tr>";
    }
}
mysqli_close($conn);
?> 