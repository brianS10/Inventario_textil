<?php
// Mostrar todos los errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conexion.php';

// Recibimos datos del formulario
$tipo = $_POST['tipo_tela'] ?? '';
$color = $_POST['color'] ?? '';
$largo = floatval($_POST['largo'] ?? 0);
$fecha = $_POST['fecha_ingreso'] ?? '';

// Validamos que todos los campos estén completos y que el largo sea positivo
if (empty($tipo) || empty($color) || empty($fecha) || $largo <= 0) {
    echo "❌ Datos inválidos. Revisa que todos los campos estén llenos y el largo sea mayor a 0.";
    exit;
}

// Preparamos la consulta para insertar el rollo
$sql = "INSERT INTO rollos (tipo_tela, color, largo_original, metros_disponibles, fecha_ingreso)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdds", $tipo, $color, $largo, $largo, $fecha);

// Ejecutamos la consulta y verificamos resultado
if ($stmt->execute()) {
    // Si se guardó bien, redirigimos a la página principal
    header("Location: index.php");
    exit;
} else {
    // Si hubo error, mostramos mensaje
    echo "❌ Error al guardar: " . $conn->error;
}
