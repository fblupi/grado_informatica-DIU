<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$idEmpresa = $_GET['i'];
$sql = "UPDATE empresa SET baja=0 WHERE id='$idEmpresa'";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);

if (!$resultado) {
  salir("Error al dar de alta", -1);
} else {
  salir("Se ha dado de alta correctamente", 0);
}

?>
