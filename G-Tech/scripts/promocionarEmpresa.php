<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$empresa = $_GET['i'];
$usuario = $_SESSION['id'];

$sqlPromocion = "SELECT promocion FROM empresa WHERE id=$empresa";
$resultadoPromocion = mysqli_query($conexion, $sqlPromocion);
$filaPromocion = mysqli_fetch_array($resultadoPromocion);
$promocion = $filaPromocion['promocion'];
$promocion++;
$sqlActualizar = "UPDATE empresa SET promocion=$promocion WHERE id=$empresa";
$resultadoActualizar = mysqli_query($conexion, $sqlActualizar);
mysqli_close($conexion);
if ($resultadoActualizar) {
  salir2("Empresa promocionada correctamente", 0, "gestionarEmpresas.php");
} else {
  salir2("Error al promocionar empresa", -1, "gestionarEmpresas.php");
}

?>
