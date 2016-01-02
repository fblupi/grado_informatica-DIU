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
  $sql = "UPDATE empresa SET baja=0 WHERE id='$empresa'";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);

  if (!$resultado) {
    salir2("Error al dar de alta", -1, "gestionarEmpresas.php");
  } else {
    salir2("Se ha dado de alta correctamente", 0, "gestionarEmpresas.php");
  }
} else {
  mysqli_close($conexion);
  salir2("El usuario no tiene permisos", -1, "gestionarEmpresas.php");
}

?>
