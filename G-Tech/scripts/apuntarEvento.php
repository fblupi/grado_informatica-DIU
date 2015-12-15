<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$usuario = $_SESSION['id'];
$evento = $_GET['i'];

$conexion = dbConnect();

$sqlDatosUsuario = "SELECT * FROM usuario WHERE id = $usuario";
$resultadoDatosUsuario = mysqli_query($conexion, $sqlDatosUsuario);
$filaDatosUsuario = mysqli_fetch_array($resultadoDatosUsuario);

if(strlen($filaDatosUsuario['nombre'])>0 && strlen($filaDatosUsuario['telefono'])>0 && strlen($filaDatosUsuario['direccion'])>0 && strlen($filaDatosUsuario['localidad'])>0  && strlen($filaDatosUsuario['pais'])>0 && strlen($filaDatosUsuario['codigoPostal'])>0){

  $sqlNumPlazas = "SELECT plazas FROM evento WHERE id=$evento";
  $resultadoNumPlazas = mysqli_query($conexion, $sqlNumPlazas);
  $filaNumPlazas = mysqli_fetch_array($resultadoNumPlazas);
  $plazas = $filaNumPlazas['plazas'];

  $sqlNumPlazasOcupadas = "SELECT COUNT(*) AS plazasOcupadas FROM asistencia WHERE evento = $evento";
  $resultadoNumPlazasOcupadas = mysqli_query($conexion, $sqlNumPlazasOcupadas);
  $filaNumPlazasOcupadas = mysqli_fetch_array($resultadoNumPlazasOcupadas);
  $plazasOcupadas = $filaNumPlazasOcupadas['plazasOcupadas'];

  if ($plazas > $plazasOcupadas) {
    $sqlAsistencia = "INSERT INTO asistencia (evento, usuario) VALUES($evento, $usuario);";
    $resultadoAsistencia = mysqli_query($conexion, $sqlAsistencia);
    mysqli_close($conexion);
    if ($resultadoAsistencia) {
      salir2("Apuntado correctamente", 0, 0);
    } else {
      salir2("Error al apuntarse", -1, 0);
    }
  } else {
    mysqli_close($conexion);
    salir2("No hay plazas disponibles", -1, 0);
  }

}else{
  mysqli_close($conexion);
  salir2("Es necesario rellenar todos los datos de perfil antes de apuntarse a un evento", -1, "editarPerfil.php");
}

?>
