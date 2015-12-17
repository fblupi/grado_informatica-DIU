<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$usuario = $_SESSION['id'];
$sala = $_GET['idSala'];
$diaEntrada = $_GET['fechaEntrada'];
$horaEntrada = $_GET['horaEntrada'];
$horaSalida = $_GET['horaSalida'];
$fechaEntrada = date('Y-m-d H:i:s', strtotime($diaEntrada.' '.$horaEntrada));
$fechaSalida = date('Y-m-d H:i:s', strtotime($diaEntrada.' '.$horaSalida));

$sql = "SELECT tipo FROM sala WHERE id=$sala";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
  $fila = mysqli_fetch_array($resultado);
  $tipo = $fila['tipo'];

  $sql = "INSERT INTO alquiler (usuario,sala,fechaInicio,fechaFin,tipoSala,asignada)
          VALUES ($usuario,$sala,'$fechaEntrada','$fechaSalida','$tipo',0)";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if ($resultado) {
    salir("Sala reservada correctamente", -1);
  } else {
    salir("Ha habido un error realizando el reserva", -1);
  }
} else {
  mysqli_close($conexion);
  salir("Ha habido un error buscando el tipo de sala", -1);
}

?>
