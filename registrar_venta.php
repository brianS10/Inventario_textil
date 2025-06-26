<?php
include 'conexion.php';

// Consultamos los rollos que tienen metros disponibles, ordenados por fecha ascendente
$sql = "SELECT * FROM rollos WHERE metros_disponibles > 0 ORDER BY fecha_ingreso ASC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Venta</title>
    <!-- Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">🧾 Registrar venta de tela</h2>

    <!-- Formulario para registrar venta -->
    <form id="form-venta">
        <div class="mb-3">
            <label for="rollo_id" class="form-label">Seleccionar rollo</label>
            <select name="rollo_id" id="rollo_id" class="form-select" required>
                <option value="">-- Selecciona una tela --</option>
                <?php while($row = $resultado->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['tipo_tela']) ?> - <?= htmlspecialchars($row['color']) ?> (<?= $row['metros_disponibles'] ?> m disponibles)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="metros_vendidos" class="form-label">Metros vendidos</label>
            <input type="number" name="metros_vendidos" id="metros_vendidos" class="form-control" step="0.01" min="0.1" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar venta</button>
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </form>

    <div id="mensaje" class="mt-4"></div>
</div>

<script>
// Enviamos el formulario por AJAX para no recargar la página
document.getElementById('form-venta').addEventListener('submit', async function(e) {
    e.preventDefault();

    const rollo_id = document.getElementById('rollo_id').value;
    const metros_vendidos = document.getElementById('metros_vendidos').value;

    const formData = new FormData();
    formData.append("rollo_id", rollo_id);
    formData.append("metros_vendidos", metros_vendidos);

    // Enviamos los datos al servidor
    const respuesta = await fetch('guardar_venta_ajax.php', {
        method: 'POST',
        body: formData
    });

    const data = await respuesta.json();
    const mensaje = document.getElementById("mensaje");
    
    // Mostramos mensaje según el resultado
    mensaje.innerHTML = `<div class="alert ${data.success ? 'alert-success' : 'alert-danger'}">${data.message}</div>`;

    // Si se guardó con éxito, reseteamos el formulario
    if (data.success) {
        this.reset();
    }
});
</script>
</body>
</html>
