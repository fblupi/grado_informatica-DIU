<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$empresa = $_GET['i'];
$usuario = $_SESSION['id'];

$sql = "UPDATE empresa SET baja=1 WHERE id='$empresa'";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);

if (!$resultado) {
  salir2("Error al dar de baja", -1, "gestionarEmpresas.php");
} else {
  salir2("Se ha dado de baja correctamente", 0, "gestionarEmpresas.php");
}

?>
