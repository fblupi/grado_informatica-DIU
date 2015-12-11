<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$idEmpresa = $_GET['i'];
$sql = "UPDATE empresa SET baja=1 WHERE id='$idEmpresa'";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);

if (!$resultado) {
  salir("Error al dar de baja", -1);
} else {
  salir("Se ha dado de baja correctamente", 0);
}

?>
