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
  $sql = "UPDATE sala SET baja=1 WHERE id=$sala";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if (!$resultado) {
    salir2("Error al dar de baja", -1, "gestionSalasAdmin.php");
  } else {
    salir2("Se ha dado de baja correctamente", 0, "gestionSalasAdmin.php");
  }
} else {
  mysqli_close($conexion);
  salir2("El usuario no tiene permisos", -1, "gestionSalasAdmin.php");
}

?>
