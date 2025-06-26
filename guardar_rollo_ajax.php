<?php
header('Content-Type: application/json');
include 'conexion.php';

// Obtenemos los datos enviados por POST, con valores por defecto
$tipo = $_POST['tipo_tela'] ?? '';
$color = $_POST['color'] ?? '';
$largo = floatval($_POST['largo'] ?? 0);
$fecha = $_POST['fecha_ingreso'] ?? '';

// Validamos que no falte nada y que largo sea positivo
if (empty($tipo) || empty($color) || empty($fecha) || $largo <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "❌ Todos los campos son obligatorios y el largo debe ser mayor a 0."
    ]);
    exit;
}

// Preparamos la consulta para insertar el rollo
$sql = "INSERT INTO rollos (tipo_tela, color, largo_original, metros_disponibles, fecha_ingreso)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
// Ligamos los parámetros, los metros_disponibles inicial son igual al largo original
$stmt->bind_param("ssdds", $tipo, $color, $largo, $largo, $fecha);

// Ejecutamos y respondemos según resultado
if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "✅ Rollo agregado correctamente"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "❌ Error al guardar: " . $conn->error
    ]);
}
