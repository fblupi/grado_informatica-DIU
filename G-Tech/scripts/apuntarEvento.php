<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$usuario = $_SESSION['id'];
$evento = $_GET['i'];

$conexion = dbConnect();

$sqlNumPlazas = "SELECT plazas FROM evento WHERE id=$evento";
$resultadoNumPlazas = mysqli_query($conexion, $sqlNumPlazas);
$filaNumPlazas = mysqli_fetch_array($resultadoNumPlazas);
$plazas = $filaNumPlazas['plazas'];

$sqlNumPlazasOcupadas = "SELECT COUNT(*) AS plazasOcupadas FROM asistencia WHERE evento = $evento";
$resultadoNumPlazasOcupadas = mysqli_query($conexion, $sqlNumPlazasOcupadas);
$filaNumPlazasOcupadas = mysqli_fetch_array($resultadoNumPlazasOcupadas);
$plazasOcupadas = $filaNumPlazasOcupadas['plazasOcupadas'];

if ($plazas > $plazasOcupadas) {
  $sqlAsistencia = "INSERT INTO asistencia (evento, usuario) VALUES($evento, $usuario);";
  $resultadoAsistencia = mysqli_query($conexion, $sqlAsistencia);
  mysqli_close($conexion);
  if ($resultadoAsistencia) {
    salir("Apuntado correctamente", 0);
  } else {
    salir("Error al apuntarse", -1);
  }
} else {
  mysqli_close($conexion);
  salir("No hay plazas disponibles", -1);
}

?>
