
<?php
require 'db.php';

$consulta_hotel = mysqli_query($conn, "SELECT * FROM reservacion2");

if (mysqli_num_rows($consulta_hotel) > 0) 
{
    while ($row = mysqli_fetch_assoc($consulta_hotel)) 
    {
        // Mapear el tipo de habitación a texto
        $tipos_habitacion = [
            1 => 'Estándar',
            2 => 'Deluxe',
            3 => 'Suite',
            4 => 'Familiar'
        ];
        
        $tipo_habitacion_texto = isset($tipos_habitacion[$row['tipo_habitacion']]) 
            ? $tipos_habitacion[$row['tipo_habitacion']] 
            : 'Desconocido';
        
        echo "<tr>
                <td>" . $row['id_reservacion'] . "</td>
                <td>" . $row['nombre'] . "</td>
                <td>" . $row['apellido'] . "</td>
                <td>" . $row['fecha_entrada'] . "</td>
                <td>" . $row['fecha_salida'] . "</td>
                <td>" . $row['adultos'] . "</td>
                <td>" . $row['kids'] . "</td>
                <td>" . $tipo_habitacion_texto . "</td>
                <td>
                    <div class=\"btn-group\">
                        <button class=\"edit-btn\" onclick=\"mostrarFormularioActualizar(" . $row['id_reservacion'] . ", '" . addslashes($row['nombre']) . "', '" . addslashes($row['apellido']) . "', '" . $row['fecha_entrada'] . "', '" . $row['fecha_salida'] . "', '" . $row['adultos'] . "', '" . $row['kids'] . "', '" . $row['tipo_habitacion'] . "')\">Editar</button>
                        <button class=\"delete-btn\" onclick=\"eliminarReservacion(" . $row['id_reservacion'] . ")\">Eliminar</button>
                    </div>
                </td>
            </tr>";
    }
} 
else 
{
    echo "<tr><td colspan='9'>No hay reservaciones registradas.</td></tr>";
}
?>