<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hotel_reservas_5';
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?> 