<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$evento = $_GET['i'];
$usuario = $_SESSION['id'];

$sqlPermiso = "SELECT empresa, usuario FROM evento WHERE id=$evento";
$resultadoPermiso = mysqli_query($conexion, $sqlPermiso);
$filaPermiso = mysqli_fetch_array($resultadoPermiso);
$representante = $filaPermiso['usuario'];
$representanteEmpresa = $filaPermiso['empresa'];
if ($filaPermiso['empresa'] != '') {
  $sqlEmpresa = "SELECT representante FROM empresa WHERE id=$representanteEmpresa";
  $resultadoEmpresa = mysqli_query($conexion, $sqlEmpresa);
  $filaEmpresa = mysqli_fetch_array($resultadoEmpresa);
  $representante = $filaEmpresa['representante'];
}

if ($representante == $usuario) {
  $sqlPromocion = "SELECT promocion FROM evento WHERE id=$evento";
  $resultadoPromocion = mysqli_query($conexion, $sqlPromocion);
  $filaPromocion = mysqli_fetch_array($resultadoPromocion);
  $promocion = $filaPromocion['promocion'];
  $promocion++;
  $sqlActualizar = "UPDATE evento SET promocion=$promocion WHERE id=$evento";
  $resultadoActualizar = mysqli_query($conexion, $sqlActualizar);
  mysqli_close($conexion);
  if ($resultadoActualizar) {
    salir("Evento promocionado correctamente", 0);
  } else {
    salir("Error al promocionar evento", -1);
  }
} else {
  mysqli_close($conexion);
  salir("El usuario no tiene permisos", -1);
}

?>
