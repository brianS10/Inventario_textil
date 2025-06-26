<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Rollo</title>
    <!-- Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Colores de las opciones para que se vean mejor */
        option[value="Rojo"] { background-color: #ff0000; color: white; }
        option[value="Azul"] { background-color: #0000ff; color: white; }
        option[value="Verde"] { background-color: #008000; color: white; }
        option[value="Amarillo"] { background-color: #ffff00; color: black; }
        option[value="Naranja"] { background-color: #ffa500; color: black; }
        option[value="Rosa"] { background-color: #ffc0cb; color: black; }
        option[value="Morado"] { background-color: #800080; color: white; }
        option[value="Negro"] { background-color: #000000; color: white; }
        option[value="Blanco"] { background-color: #ffffff; color: black; }
        option[value="Gris"] { background-color: #808080; color: white; }
        option[value="Marrón"] { background-color: #8b4513; color: white; }
        option[value="Celeste"] { background-color: #87ceeb; color: black; }
        option[value="Vino"] { background-color: #800000; color: white; }
        option[value="Beige"] { background-color: #f5f5dc; color: black; }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">➕ Agregar nuevo rollo de tela</h2>

    <!-- Formulario para agregar rollo -->
    <form id="form-rollo">
        <div class="mb-3">
            <label for="tipo_tela" class="form-label">Tipo de tela</label>
            <select name="tipo_tela" id="tipo_tela" class="form-select" required>
                <option value="">-- Selecciona un tipo --</option>
                <option value="Algodón">Algodón</option>
                <option value="Lino">Lino</option>
                <option value="Seda">Seda</option>
                <option value="Poliéster">Poliéster</option>
                <option value="Lana">Lana</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <select name="color" id="color" class="form-select" required>
                <option value="">-- Selecciona un color --</option>
                <option value="Rojo">Rojo</option>
                <option value="Azul">Azul</option>
                <option value="Verde">Verde</option>
                <option value="Amarillo">Amarillo</option>
                <option value="Naranja">Naranja</option>
                <option value="Rosa">Rosa</option>
                <option value="Morado">Morado</option>
                <option value="Negro">Negro</option>
                <option value="Blanco">Blanco</option>
                <option value="Gris">Gris</option>
                <option value="Marrón">Marrón</option>
                <option value="Celeste">Celeste</option>
                <option value="Vino">Vino</option>
                <option value="Beige">Beige</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="largo" class="form-label">Largo del rollo (en metros)</label>
            <input type="number" name="largo" id="largo" class="form-control" step="0.01" min="0.1" required>
        </div>

        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </form>

    <!-- Aquí mostramos mensajes al usuario -->
    <div id="mensaje" class="mt-4"></div>
</div>

<script>
// Capturamos el envío del formulario para usar AJAX
document.getElementById("form-rollo").addEventListener("submit", async function(e) {
    e.preventDefault(); // evitamos que recargue la página

    const formData = new FormData(this); // obtenemos los datos del formulario

    // Enviamos los datos al servidor usando fetch
    const respuesta = await fetch("guardar_rollo_ajax.php", {
        method: "POST",
        body: formData
    });

    const data = await respuesta.json(); // recibimos respuesta JSON
    const mensajeDiv = document.getElementById("mensaje");

    // Mostramos mensaje de éxito o error
    mensajeDiv.innerHTML = `<div class="alert ${data.success ? 'alert-success' : 'alert-danger'}">${data.message}</div>`;

    if (data.success) {
        this.reset(); // limpiamos formulario si se guardó bien
    }
});
</script>
</body>
</html>
