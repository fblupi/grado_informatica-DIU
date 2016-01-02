<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$evento = $_GET['i'];
$usuario = $_SESSION['id'];

$sqlPromocion = "SELECT promocion FROM evento WHERE id=$evento";
$resultadoPromocion = mysqli_query($conexion, $sqlPromocion);
$filaPromocion = mysqli_fetch_array($resultadoPromocion);
$promocion = $filaPromocion['promocion'];
$promocion++;
$sqlActualizar = "UPDATE evento SET promocion=$promocion WHERE id=$evento";
$resultadoActualizar = mysqli_query($conexion, $sqlActualizar);
mysqli_close($conexion);
if ($resultadoActualizar) {
  salir2("Evento promocionado correctamente", 0, "gestionarEventos.php");
} else {
  salir2("Error al promocionar evento", -1, "gestionarEventos.php");
}

?>
