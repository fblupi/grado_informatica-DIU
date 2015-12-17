<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
  session_start();
}

$conexion = dbConnect();
$evento = $_GET['i'];

$sql = "SELECT sala FROM evento WHERE id=$evento";
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
  $fila = mysqli_fetch_array($resultado);
  $alquiler = $fila['sala'];
  $sql = "UPDATE evento SET sala=NULL WHERE id=$evento";
  $resultado = mysqli_query($conexion, $sql);
  if ($resultado) {
    $sql = "UPDATE alquiler SET asignada=0 WHERE id=$alquiler";
    $resultado = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    if ($resultado) {
      salir("Sala desasignada correctamente", 0);
    } else {
      salir("Ha habido un error desasignando la sala volviéndola a poner como disponible", -1);
    }
  } else {
    mysqli_close($conexion);
    salir("Ha habido un error desasignando la sala del evento", -1);
  }
  
} else {
  mysqli_close($conexion);
  salir("Ha habido un error buscando la información del evento", -1);
}

?>
