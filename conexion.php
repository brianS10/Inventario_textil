<?php
// Datos para la conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "inventario_textil";

// Creamos la conexión usando mysqli
$conn = new mysqli($host, $user, $pass, $db);

// Verificamos si hubo error al conectar
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
