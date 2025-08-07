<?php
require_once '../libreria/db.php';
$sql = "SELECT * FROM categorias";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_categoria'] . "</td>";
        echo "<td>" . $row['nombre_categoria'] . "</td>";
        echo "<td>" . (isset($row['descripcion']) ? $row['descripcion'] : 'N/A') . "</td>";
        echo '<td>
                <div class="btn-group">
                    <button class="edit-btn" onclick="mostrarFormularioActualizar(' . $row['id_categoria'] . ', \'' . addslashes($row['nombre_categoria']) . '\', \'' . addslashes(isset($row['descripcion']) ? $row['descripcion'] : '') . '\')">Editar</button>
                    <button class="delete-btn" onclick="eliminarCategoria(' . $row['id_categoria'] . ')">Eliminar</button>
                </div>
              </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No hay categorías registradas.</td></tr>";
}
mysqli_close($conn);
?> 