<?php

include_once "../libs/myLib.php";

$email = $_POST['correo'];

$conexion = dbConnect();
$sql = "SELECT id FROM usuario WHERE email='$email'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_fetch_array($resultado)) {
  $pass = randomPassword();
  $cryptedPass = md5($pass);
  $sql = "UPDATE usuario SET pass='$cryptedPass' WHERE email='$email'";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if ($resultado) {
    $asunto = "Cambio de contraseña";
    $mensaje = "Su nueva contraseña es: " . $pass;
    envioCorreo($email, $asunto, $mensaje);
    salir2("Se le ha enviado una nueva contraseña al email indicado. Revise su bandeja de entrada", 0, "inicioSesion.php");
  } else {
    salir2("Error generando la contraseña", -1, "inicioSesion.php");
  }
} else {
  mysqli_close($conexion);
  salir2("Email no válido", -1, "inicioSesion.php");
}

?>
