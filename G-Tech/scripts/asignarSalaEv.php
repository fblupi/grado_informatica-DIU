<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$alquiler = $_GET['idSala'];
$evento = $_GET['idEvento'];

$sql = "UPDATE evento SET sala=$alquiler WHERE id=$evento";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
  $sql = "UPDATE alquiler SET asignada=1 WHERE id=$alquiler";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if ($resultado) {
    salir2("Sala asignada correctamente", 0, "gestionarEventos.php");
  } else {
    salir2("Ha habido un error realizando la asignación de la sala poniéndola como no disponible", -1, "gestionarEventos.php");
  }
} else {
  mysqli_close($conexion);
  salir2("Ha habido un error realizando la asignación de la sala al evento", -1, "gestionarEventos.php");
}

?>
