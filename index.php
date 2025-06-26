<?php
include 'conexion.php';

// Obtenemos el parámetro 'orden' desde la URL, por defecto 'fecha'
$orden = $_GET['orden'] ?? 'fecha';

// Definimos la consulta según el orden seleccionado
if ($orden === 'stock') {
    $sql = "SELECT * FROM rollos ORDER BY metros_disponibles ASC";
} else {
    $sql = "SELECT * FROM rollos ORDER BY fecha_ingreso DESC";
}

// Ejecutamos la consulta
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario Textil</title>
    <!-- Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="mb-4">📦 Inventario de Telas</h1>

        <!-- Botones para agregar, registrar venta y ordenar -->
        <div class="mb-3 d-flex flex-wrap gap-2">
            <a href="agregar_rollo.php" class="btn btn-success">➕ Agregar nuevo rollo</a>
            <a href="registrar_venta.php" class="btn btn-primary">🧾 Registrar venta</a>
            <a href="index.php?orden=fecha" class="btn btn-outline-secondary">📅 Ordenar por fecha</a>
            <a href="index.php?orden=stock" class="btn btn-outline-secondary">📉 Ordenar por stock</a>
        </div>

        <!-- Tabla para mostrar los rollos -->
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Tipo de Tela</th>
                    <th>Color</th>
                    <th>Metros Disponibles</th>
                    <th>Fecha de Ingreso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['tipo_tela']) ?></td>
                    <td><?= htmlspecialchars($row['color']) ?></td>
                    <td><?= $row['metros_disponibles'] ?> m</td>
                    <td><?= $row['fecha_ingreso'] ?></td>
                    <td>
                        <a href="editar_rollo.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏️</a>
                        <a href="eliminar_rollo.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este rollo?');">🗑</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
