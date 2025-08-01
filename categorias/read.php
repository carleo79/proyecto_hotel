<?php
require_once '../libreria/db.php';
$sql = "SELECT * FROM categorias";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_categoria'] . "</td>";
        echo "<td>" . $row['nombre_categoria'] . "</td>";
        echo '<td><div class="btn-group" role="group" aria-label="Acciones">'
            . '<a href="update.php?id_categoria=' . $row['id_categoria'] . '" class="btn btn-sm btn-warning">Editar</a>'
            . '<a href="delete.php?id_categoria=' . $row['id_categoria'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'¿Seguro que deseas eliminar esta categoría?\')">Eliminar</a>'
            . '</div></td>';
        echo "</tr>";
    }
}
mysqli_close($conn);
?> 