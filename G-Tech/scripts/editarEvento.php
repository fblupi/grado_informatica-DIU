<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$evento = $_POST['id'];

$nombre = $_POST['nombre'];
$fechaInicio= $_POST['fechaInicio'];
$horaInicio = $_POST['horaInicio'];
$fechaFin = $_POST['fechaInicio'];
$horaFin = $_POST['horaFin'];
$precio = $_POST['precio'];
$plazas = $_POST['plazas'];
$descripcion = $_POST['descripcion'];
$requisitos = $_POST['requisitos'];
$imagen = "assets/img/evento.png";
$empresa = "";
$usuario = "";

$empresaUsuario = true;
$todoInicio = date('Y-m-d H:i:s',strtotime($fechaInicio.' '.$horaInicio));
$todoFin = date('Y-m-d H:i:s',strtotime($fechaFin.' '.$horaFin));

$salir = false;
if ($_POST['empresa'] != "" && $_POST['usuario'] == ""){
  $empresa=$_POST['empresa'];
}
else if ($_POST['empresa'] == "" && $_POST['usuario'] != ""){
  $usuario=$_POST['usuario'];
  $empresaUsuario = false;
} else {
  $salir = true;
}

if (!$salir) {
  $conexion = dbConnect();

  if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
    $subidaCorrecta = false;
    if ($_FILES['imagen']['error'] > 0) {
      salir("Ha ocurrido un error en la carga de la imagen", -1);
    } else {
      $extensiones = array("image/jpg", "image/jpeg", "image/png");
      $limite = 4096;
      if (in_array($_FILES['imagen']['type'], $extensiones) && $_FILES['imagen']['size'] < $limite * 1024) {
        $foldername = "assets/img/eventos";
        $foldermkdir = "../" . $foldername;
        if (!is_dir($foldermkdir)) {
          mkdir($foldermkdir, 0777, true);
        }
        $extension = "." . split("/", $_FILES['imagen']['type'])[1];
        $filename = $evento . $extension;
        $ruta = $foldername . "/" . $filename;
        $rutacrear = $foldermkdir . "/" . $filename;
        if (!file_exists($rutacrear)) {
          $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacrear);
        } else {
          unlink($rutacrear);
          $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacrear);
        }
        if ($subidaCorrecta) {
          $imagen = $ruta;
        }
      }
      if ($subidaCorrecta) {

        //Comprobación de si el representante es usuario o es una empresa
        if($empresaUsuario)
          $sql = "UPDATE evento SET nombre='$nombre', fechaInicio='$todoInicio', fechaFin='$todoFin', precio='$precio', plazas='$plazas', descripcion='$descripcion', requisitos='$requisitos', imagen='$imagen', empresa='$empresa', usuario=NULL WHERE id=$evento";
        else
          $sql = "UPDATE evento SET nombre='$nombre', fechaInicio='$todoInicio', fechaFin='$todoFin', precio='$precio', plazas='$plazas', descripcion='$descripcion', requisitos='$requisitos', imagen='$imagen', usuario='$usuario', empresa=NULL WHERE id=$evento";

        $resultado = mysqli_query($conexion, $sql);
        mysqli_close($conexion);
        if ($resultado) {
          salir("Evento editado correctamente", 0);
        } else {
          unlink($ruta);
          salir("Ha ocurrido un error con la imagen", -1);
        }
      } else { // No se ha subido la imagen
        mysqli_close($conexion);
        salir("Ha ocurrido un error subiendo la imagen", -1);
      }
    }
  } else { // No hay imagen
    //Comprobación de si el representante es usuario o es una empresa
    if($empresaUsuario)
      $sql = "UPDATE evento SET nombre='$nombre', fechaInicio='$todoInicio', fechaFin='$todoFin', precio='$precio', plazas='$plazas', descripcion='$descripcion', requisitos='$requisitos', empresa='$empresa', usuario=NULL WHERE id=$evento";
    else
      $sql = "UPDATE evento SET nombre='$nombre', fechaInicio='$todoInicio', fechaFin='$todoFin', precio='$precio', plazas='$plazas', descripcion='$descripcion', requisitos='$requisitos', usuario='$usuario', empresa=NULL WHERE id=$evento";

    $resultado = mysqli_query($conexion, $sql);
    mysqli_close($conexion);
    if ($resultado) {
      salir("Evento editado correctamente", 0);
    } else {
      salir("Error al editar evento", -1);
    }
  }
} else {
  salir("No se ha introducido correctamente el organizador", -1);
}

?>
