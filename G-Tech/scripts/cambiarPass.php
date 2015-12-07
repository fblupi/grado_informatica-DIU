<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$pass = md5($_POST['newPass']);

$conexion = dbConnect();
$sql = "UPDATE usuario SET pass='" . $pass . "' WHERE login='" . $_SESSION['login'] . "'";
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);

if (!$resultado) {
  salir("Error al modificar contraseña", -1);
} else {
  salir("Contraseña actualizada correctamente", 0);
}

?>
