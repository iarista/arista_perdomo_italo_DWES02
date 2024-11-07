<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Vehículo</title>
</head>
<body>
    <h1>Reserva de Vehículo</h1>
    <form action="procesar_reserva.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido"><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni"><br>

        <label for="modelo">Modelo del Vehículo:</label>
        <select name="modelo" id="modelo">
            <option value="Lancia Stratos">Lancia Stratos</option>
            <option value="Audi Quattro">Audi Quattro</option>
            <option value="Ford Escort RS1800">Ford Escort RS1800</option>
            <option value="Subaru Impreza 555">Subaru Impreza 555</option>
        </select><br>

        <label for="fecha_inicio">Fecha de Inicio de la Reserva:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio"><br>

        <label for="duracion">Duración de la Reserva (días):</label>
        <input type="number" name="duracion" id="duracion"><br>

        <button type="submit">Reservar</button>
    </form>
</body>
</html>
