<?php
include 'conexion.php';

// Obtenemos el id desde GET, o null si no viene
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "❌ ID inválido";
    exit;
}

// Primero eliminamos las ventas relacionadas con este rollo para evitar errores por llave foránea
$conn->query("DELETE FROM ventas WHERE rollo_id = $id");

// Ahora eliminamos el rollo
$sql = "DELETE FROM rollos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Si se eliminó bien, redirigimos a la página principal
    header("Location: index.php");
    exit;
} else {
    // Si hubo error, mostramos el mensaje
    echo "❌ Error al eliminar: " . $conn->error;
}
