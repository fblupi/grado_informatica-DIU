<?php

include_once "../libs/myLib.php";

$login = $_POST['login'];
$pass = md5($_POST['pass']);

$conexion = dbConnect();
$sql = "SELECT * FROM usuario WHERE usuario.login='$login'";
$resultado = mysqli_query($conexion, $sql);

if ($row = mysqli_fetch_array($resultado)) {
  if($row['pass'] == $pass) {
    session_start();
    $_SESSION['login'] = $login;
    $_SESSION['id'] = $row['id'];
    mysqli_close($conexion);
    salir("Se ha iniciado sesión correctamente", 0);
  } else {
    mysqli_close($conexion);
    salir("El nombre de usuario o la contraseña no son correctos", -1);
  }
} else {
  mysqli_close($conexion);
  salir("No existe ese usuario en el sistema", -1);
}

?>
