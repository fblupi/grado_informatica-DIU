<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$pass = md5($_POST['pass']);

$conexion = dbConnect();
$sql = "UPDATE usuario SET pass=$pass WHERE usuario.login=$_SESSION['login'];
$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);

?>
