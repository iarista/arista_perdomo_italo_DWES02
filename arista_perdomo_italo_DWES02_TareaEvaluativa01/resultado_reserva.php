<?php
session_start();
$status = $_GET['status'];

if ($status === "success") {
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $modelo = $_GET['modelo'];
    echo "<h1>Reserva Confirmada</h1>";
    echo "<p>Reservado por: $nombre $apellido</p>";
    echo "<img src='images/$modelo.jpg' alt='$modelo'>";
} else {
    echo "<h1>Error en la Reserva</h1>";
    foreach ($_SESSION['errores'] as $campo => $error) {
        $color = empty($error) ? 'green' : 'red';
        echo "<p style='color: $color;'>$campo: $error</p>";
    }
}
?>
