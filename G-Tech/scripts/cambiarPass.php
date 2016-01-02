<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$pass = md5($_POST['pass']);
$newPass = md5($_POST['newPass']);

$conexion = dbConnect();

$sql = "SELECT pass FROM usuario WHERE login='".$_SESSION['login']."'";
$resultado = mysqli_query($conexion, $sql);
$oldPass = mysqli_fetch_array($resultado);

if ($oldPass['pass'] == $pass) {
	$sql = "UPDATE usuario SET pass='" . $newPass . "' WHERE login='" . $_SESSION['login'] . "'";
	$resultado = mysqli_query($conexion, $sql);
	mysqli_close($conexion);
	if (!$resultado) {
	  salir2("Error al modificar contraseña", -1, "miCuenta.php");
	} else {
	  salir2("Contraseña actualizada correctamente", 0, "miCuenta.php");
	}
} else {
	mysqli_close($conexion);
  	salir2("Contraseña inválida", -1, "cambiarPass.php");
}


?>
