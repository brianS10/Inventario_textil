<?php
header('Content-Type: application/json');
include 'conexion.php';

// Obtenemos datos enviados por POST
$rollo_id = $_POST['rollo_id'] ?? null;
$metros_vendidos = floatval($_POST['metros_vendidos'] ?? 0);

// Validamos datos básicos
if (!$rollo_id || $metros_vendidos <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "Datos inválidos."
    ]);
    exit;
}

// Consultamos metros disponibles del rollo
$sql_check = "SELECT metros_disponibles FROM rollos WHERE id = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("i", $rollo_id);
$stmt->execute();
$result = $stmt->get_result();

// Validamos que exista el rollo
if ($result->num_rows === 0) {
    echo json_encode([
        "success" => false,
        "message" => "Rollo no encontrado."
    ]);
    exit;
}

$rollo = $result->fetch_assoc();
$disponibles = $rollo['metros_disponibles'];

// Verificamos que no se venda más de lo disponible
if ($metros_vendidos > $disponibles) {
    echo json_encode([
        "success" => false,
        "message" => "No puedes vender más de {$disponibles} m disponibles."
    ]);
    exit;
}

// Registramos la venta
$sql_insert = "INSERT INTO ventas (rollo_id, metros_vendidos) VALUES (?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("id", $rollo_id, $metros_vendidos);
$stmt_insert->execute();

// Actualizamos el stock disponible
$nuevo_stock = $disponibles - $metros_vendidos;
$sql_update = "UPDATE rollos SET metros_disponibles = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("di", $nuevo_stock, $rollo_id);
$stmt_update->execute();

// Enviamos respuesta exitosa
echo json_encode([
    "success" => true,
    "message" => "✅ Venta registrada con éxito."
]);
