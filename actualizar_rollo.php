<?php
// Incluimos la conexión a la base de datos
include 'conexion.php';

// Recibimos los datos enviados por POST
$id = $_POST['id'];
$tipo = $_POST['tipo_tela'];
$color = $_POST['color'];
$fecha = $_POST['fecha_ingreso'];

// Verificamos que no falte ningún dato
if (!$id || !$tipo || !$color || !$fecha) {
    echo "❌ Datos incompletos";
    exit;
}

// Preparamos la consulta para actualizar el rollo
$sql = "UPDATE rollos SET tipo_tela = ?, color = ?, fecha_ingreso = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

// Ligamos los parámetros con sus tipos: s = string, i = integer
$stmt->bind_param("sssi", $tipo, $color, $fecha, $id);

// Ejecutamos la consulta y verificamos si fue exitosa
if ($stmt->execute()) {
    // Si se actualizó bien, redirigimos al inicio
    header("Location: index.php");
    exit;
} else {
    // Si hubo error, mostramos el mensaje
    echo "Error al actualizar: " . $conn->error;
}
