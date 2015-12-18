<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$login = $_SESSION['login'];
$inputMails = $_POST['emails'];
$evento = $_POST['id'];

$mails = explode(',', $inputMails);

if (count($mails) == 0) {
  salir("No se ha introducido ningún correo", -1);
}

$conexion = dbConnect();
$sql = "SELECT nombre, fechaInicio, fechaFin, precio FROM evento WHERE id=$evento";
$resultado = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($resultado);

mysqli_close($conexion);

$nombre = $row['nombre'];
$fechaInicio = $row['fechaInicio'];
$fechaFin = $row['fechaFin'];
$precio = $row['precio'];
$asunto = "Invitación al evento " . $nombre;
if($precio!=0){
  $mensaje = "¡Hola!<br>, Has sido invitado por " . $login . " al evento " . $nombre . " que tendrá lugar de " . date('d-m-Y H:i',strtotime($fechaInicio)) . " a " . date('d-m-Y H:i',strtotime($fechaFin)) . ".<br> Este evento tiene un coste de " . $precio . "€.";
}else{
  $mensaje = "¡Hola!<br>, Has sido invitado por " . $login . " al evento " . $nombre . " que tendrá lugar de " . date('d-m-Y H:i',strtotime($fechaInicio)) . " a " . date('d-m-Y H:i',strtotime($fechaFin)) . ".<br> Este evento es totalmente gratuíto";
}

foreach ($mails as $mail) {
  envioCorreo($mail, $asunto, $mensaje);
}

salir("Invitaciones enviadas correctamente", 0);

?>
