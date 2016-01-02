<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$usuario = $_SESSION['id'];
$sala = $_POST['idSala'];
$diaEntrada = $_POST['fechaEntrada'];
$horaEntrada = $_POST['horaEntrada'];
$diaSalida = $_POST['fechaSalida'];
$horaSalida = $_POST['horaSalida'];
$fechaEntrada = date('Y-m-d H:i:s', strtotime($diaEntrada.' '.$horaEntrada));
$fechaSalida = date('Y-m-d H:i:s', strtotime($diaSalida.' '.$horaSalida));

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
    salir2("Sala alquilada correctamente", 0, "misSalas.php");
  } else {
    salir2("Ha habido un error realizando el alquiler", -1, "buscarSalas.php");
  }
} else {
  mysqli_close($conexion);
  salir2("Ha habido un error buscando el tipo de sala", -1, "buscarSalas.php");
}

?>
