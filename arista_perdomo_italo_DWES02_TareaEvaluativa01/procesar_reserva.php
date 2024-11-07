<?php
include 'usuarios_y_coches.php';

// function validar_dni($dni) {
//     $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
//     $num = substr($dni, 0, -1);
//     $letra = strtoupper(substr($dni, -1));
//     return $letras[$num % 23] == $letra;
// }

function validar_dni($dni) {
    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    $num = intval(substr($dni, 0, -1)); // Convertimos a entero
    $letra = strtoupper(substr($dni, -1));
    return $letras[$num % 23] == $letra;
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$modelo = $_POST['modelo'];
$fecha_inicio = $_POST['fecha_inicio'];
$duracion = (int)$_POST['duracion'];

$errores = [];

// Validación de datos
if (empty($nombre)) $errores['nombre'] = "Nombre no puede estar vacío.";
if (empty($apellido)) $errores['apellido'] = "Apellido no puede estar vacío.";
if (!validar_dni($dni)) $errores['dni'] = "DNI no válido.";

// Validación de usuario
$usuario_valido = false;
foreach (USUARIOS as $usuario) {
    if ($usuario['dni'] === $dni && $usuario['nombre'] === $nombre  && $usuario['apellido'] === $apellido) {
        $usuario_valido = true;
        break;
    }
}
if (!$usuario_valido) $errores['usuario'] = "Usuario no registrado.";

// Validación de reserva
if (strtotime($fecha_inicio) <= strtotime(date('Y-m-d'))) {
    $errores['fecha_inicio'] = "La fecha debe ser futura.";
}
if ($duracion < 1 || $duracion > 30) {
    $errores['duracion'] = "Duración inválida.";
}

// Comprobación de disponibilidad del vehículo
$disponible = false;
foreach ($coches as &$coche) {
    if ($coche['modelo'] === $modelo) {
        if ($coche['disponible']) {
            $disponible = true;
        } else {
            $inicio_reservado = strtotime($coche['fecha_inicio']);
            $fin_reservado = strtotime($coche['fecha_fin']);
            $nueva_inicio = strtotime($fecha_inicio);
            $nueva_fin = strtotime("+$duracion days", $nueva_inicio);

            // Verificar si las fechas no se superponen
            if ($nueva_inicio >= $fin_reservado || $nueva_fin <= $inicio_reservado) {
                $disponible = true;
            }
        }
        break;
    }
}
if (!$disponible) $errores['modelo'] = "El vehículo no está disponible en las fechas seleccionadas.";

if (empty($errores)) {
    header("Location: resultado_reserva.php?status=success&nombre=$nombre&apellido=$apellido&modelo=$modelo");
} else {
    session_start();
    $_SESSION['errores'] = $errores;
    header("Location: resultado_reserva.php?status=failed");
}
?>
