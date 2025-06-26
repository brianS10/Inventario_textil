<?php
// Mostrar todos los errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php';

// Obtenemos los datos enviados por POST
$rollo_id = $_POST['rollo_id'];
$metros_vendidos = $_POST['metros_vendidos'];

// Validamos que los datos sean correctos
if (!$rollo_id || $metros_vendidos <= 0) {
    echo "❌ Datos inválidos.";
    exit;
}

// Consultamos los metros disponibles del rollo
$sql_check = "SELECT metros_disponibles FROM rollos WHERE id = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("i", $rollo_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificamos que el rollo exista
if ($result->num_rows === 0) {
    echo "❌ Rollo no encontrado.";
    exit;
}

$rollo = $result->fetch_assoc();
$disponibles = $rollo['metros_disponibles'];

// Verificamos que no se vendan más metros de los que hay disponibles
if ($metros_vendidos > $disponibles) {
    echo "❌ No puedes vender más de {$disponibles} metros.";
    exit;
}

// Registramos la venta en la tabla ventas
$sql_insert = "INSERT INTO ventas (rollo_id, metros_vendidos) VALUES (?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("id", $rollo_id, $metros_vendidos);
$stmt_insert->execute();

// Actualizamos el stock disponible en la tabla rollos
$nuevo_stock = $disponibles - $metros_vendidos;
$sql_update = "UPDATE rollos SET metros_disponibles = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("di", $nuevo_stock, $rollo_id);
$stmt_update->execute();

// Mostramos mensaje de éxito y link para volver
echo "<h3 style='text-align:center; margin-top: 50px;'>✅ Venta registrada correctamente</h3>";
echo "<div style='text-align:center;'><a href='index.php' class='btn btn-success mt-3'>Volver al Inventario</a></div>";
