<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$empresa = $_GET['i'];
$usuario = $_SESSION['id'];

$sql = "SELECT representante FROM empresa WHERE id=$empresa";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_array($resultado);
$representante = $fila['representante'];

if ($representante == $usuario) {
  $sql = "UPDATE empresa SET baja=1 WHERE id='$empresa'";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);

  if (!$resultado) {
    salir("Error al dar de baja", -1);
  } else {
    salir("Se ha dado de baja correctamente", 0);
  }
} else {
  mysqli_close($conexion);
  salir("El usuario no tiene permisos", -1);
}

?>
