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
  $sql = "UPDATE evento SET imagen='assets/img/eventoCancelado.png', baja=1, promocion=0 WHERE id=$evento";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if ($resultado) {
    salir("Evento cancelado correctamente", 0);
  } else {
    salir("Error al cancelar evento", -1);
  }
} else {
  mysqli_close($conexion);
  salir("El usuario no tiene permisos", -1);
}

?>
