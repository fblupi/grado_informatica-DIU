<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$usuario = $_SESSION['id'];
$evento = $_GET['i'];

$conexion = dbConnect();

$sql = "DELETE FROM asistencia WHERE evento=$evento AND usuario=$usuario";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);

if ($resultado) {
  salir("Desapuntado correctamente", 0);
} else {
  salir("Error al desapuntarse", -1);
}

?>
