<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
  session_start();
}

$conexion = dbConnect();
$empresa = $_GET['i'];

$sql = "SELECT sala FROM empresa WHERE id=$empresa";
$resultado = mysqli_query($conexion, $sql);
if ($resultado) {
  $fila = mysqli_fetch_array($resultado);
  $alquiler = $fila['sala'];
  $sql = "UPDATE empresa SET sala=NULL WHERE id=$empresa";
  $resultado = mysqli_query($conexion, $sql);
  if ($resultado) {
    $sql = "UPDATE alquiler SET asignada=0 WHERE id=$alquiler";
    $resultado = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    if ($resultado) {
      salir2("Sala desasignada correctamente", 0, "gestionarEmpresas.php");
    } else {
      salir2("Ha habido un error desasignando la sala volviéndola a poner como disponible", -1, "gestionarEmpresas.php");
    }
  } else {
    mysqli_close($conexion);
    salir2("Ha habido un error desasignando la sala de la empresa", -1, "gestionarEmpresas.php");
  }
  
} else {
  mysqli_close($conexion);
  salir2("Ha habido un error buscando la información de la empresa", -1, "gestionarEmpresas.php");
}

?>
