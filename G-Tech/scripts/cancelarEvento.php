<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();
$evento = $_GET['i'];
$usuario = $_SESSION['id'];

$sql = "UPDATE evento SET imagen='assets/img/eventoCancelado.png', baja=1, promocion=0 WHERE id=$evento";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);
if ($resultado) {
  salir2("Evento cancelado correctamente", 0, "gestionarEventos.php");
} else {
  salir2("Error al cancelar evento", -1, "gestionarEventos.php");
}

?>
