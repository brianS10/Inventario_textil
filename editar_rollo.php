<?php
include 'conexion.php';

// Obtenemos el id desde GET, o null si no viene
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID no válido";
    exit;
}

// Preparamos la consulta para obtener el rollo con ese id
$sql = "SELECT * FROM rollos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$rollo = $result->fetch_assoc();

if (!$rollo) {
    echo "Rollo no encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Rollo</title>
    <!-- Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Colores para opciones del select */
        option[value="Rojo"]       { background-color: #ff0000; color: white; }
        option[value="Azul"]       { background-color: #0000ff; color: white; }
        option[value="Verde"]      { background-color: #008000; color: white; }
        option[value="Amarillo"]   { background-color: #ffff00; color: black; }
        option[value="Naranja"]    { background-color: #ffa500; color: black; }
        option[value="Rosa"]       { background-color: #ffc0cb; color: black; }
        option[value="Morado"]     { background-color: #800080; color: white; }
        option[value="Negro"]      { background-color: #000000; color: white; }
        option[value="Blanco"]     { background-color: #ffffff; color: black; }
        option[value="Gris"]       { background-color: #808080; color: white; }
        option[value="Marrón"]     { background-color: #8b4513; color: white; }
        option[value="Celeste"]    { background-color: #87ceeb; color: black; }
        option[value="Vino"]       { background-color: #800000; color: white; }
        option[value="Beige"]      { background-color: #f5f5dc; color: black; }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">✏️ Editar rollo de tela</h2>

    <!-- Formulario para actualizar rollo -->
    <form action="actualizar_rollo.php" method="POST">
        <!-- Campo oculto para enviar el id -->
        <input type="hidden" name="id" value="<?= $rollo['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Tipo de tela</label>
            <select name="tipo_tela" class="form-select" required>
                <?php
                $tipos = ['Algodón', 'Lino', 'Seda', 'Poliéster', 'Lana'];
                foreach ($tipos as $tipo):
                    // Marcamos seleccionado el tipo que corresponde
                    $selected = ($rollo['tipo_tela'] === $tipo) ? 'selected' : '';
                    echo "<option value='$tipo' $selected>$tipo</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <select name="color" class="form-select" required>
                <?php
                $colores = ['Rojo','Azul','Verde','Amarillo','Naranja','Rosa','Morado','Negro','Blanco','Gris','Marrón','Celeste','Vino','Beige'];
                foreach ($colores as $c):
                    // Marcamos seleccionado el color actual
                    $selected = ($rollo['color'] === $c) ? 'selected' : '';
                    echo "<option value='$c' $selected>$c</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" class="form-control" value="<?= $rollo['fecha_ingreso'] ?>" required>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
