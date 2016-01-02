<?php
include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}
$conexion = dbConnect();
$idUsuario = $_SESSION['id'];
$alquiler = $_GET['i'];
$sql = "SELECT * FROM alquiler WHERE id = '$alquiler'";
$resultado = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_array($resultado);

$sql1;

if($resultado){
  if($fila['tipoSala']=="empresa")
    $sql1="UPDATE empresa SET sala=NULL WHERE sala='$alquiler'";
  else
    $sql1="UPDATE evento SET sala=NULL WHERE sala='$alquiler'";

  $sql0="DELETE FROM alquiler WHERE id = '$alquiler'";

  $resultado1 = mysqli_query($conexion, $sql1);
  $resultado0 = mysqli_query($conexion,$sql0);

  if ($resultado) {
    salir2("Alquiler cancelado correctamente", 0, "misSalas.php");
  } else {
    salir2("Error al cancelar evento", -1, "misSalas.php");
  }
}
else {
  mysqli_close($conexion);
  salir2("Error ", -1, "misSalas.php");
}

?>