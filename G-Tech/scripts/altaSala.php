<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$sala = $_GET['i'];
$usuario = $_SESSION['id'];

$sql = "SELECT permiso FROM usuario_permisos WHERE usuario=$usuario";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_array($resultado);
$permiso = $fila['permiso'];

if ($permiso == 1) {
  $sql = "UPDATE sala SET baja=0 WHERE id=$sala";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if (!$resultado) {
    salir("Error al dar de alta", -1);
  } else {
    salir("Se ha dado de alta correctamente", 0);
  }
} else {
  mysqli_close($conexion);
  salir("El usuario no tiene permisos", -1);
}

?>
