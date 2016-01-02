<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$alquiler = $_GET['idSala'];
$empresa = $_GET['idEmpresa'];

$sql = "UPDATE empresa SET sala=$alquiler WHERE id=$empresa";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
  $sql = "UPDATE alquiler SET asignada=1 WHERE id=$alquiler";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if ($resultado) {
    salir2("Sala asignada correctamente", 0, "gestionarEmpresas.php");
  } else {
    salir2("Ha habido un error realizando la asignación de la sala poniéndola como no disponible", -1, "gestionarEmpresas.php");
  }
} else {
  mysqli_close($conexion);
  salir2("Ha habido un error realizando la asignación de la sala a la empresa", -1, "gestionarEmpresas.php");
}

?>
