<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$usuario = $_SESSION['id'];
$sala = $_POST['sala'];
$nombre = $_POST['nombre'];
$capacidad = $_POST['capacidad'];
$tipo = $_POST['tipo'];
$planta = $_POST['planta'];
$numero = $_POST['numero'];

$conexion = dbConnect();

if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
  $subidaCorrecta = false;
  if ($_FILES['imagen']['error'] > 0) {
    salir("Ha ocurrido un error en la carga de la imagen", -1);
  } else {
    $extensiones = array("image/jpg", "image/jpeg", "image/png");
    $limite = 4096;
    if (in_array($_FILES['imagen']['type'], $extensiones) && $_FILES['imagen']['size'] < $limite * 1024) {
      $foldername = "assets/img/salas";
      $foldermkdir = "../" . $foldername;
      if (!is_dir($foldermkdir)) {
        mkdir($foldermkdir, 0777, true);
      }
      $extension = "." . split("/", $_FILES['imagen']['type'])[1];
      $filename = $sala . $extension;
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
      $sql = "UPDATE sala SET tipo='$tipo', nombre='$nombre', planta=$planta, numero=$numero, capacidad=$capacidad, imagen='$imagen' WHERE id=$sala";
      $resultado = mysqli_query($conexion, $sql);
      mysqli_close($conexion);
      if ($resultado) {
        salir("Sala añadida correctamente", 0);
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
  $sql = "UPDATE sala SET tipo='$tipo', nombre='$nombre', planta=$planta, numero=$numero, capacidad=$capacidad WHERE id=$sala";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if ($resultado) {
    salir("Sala editada correctamente", 0);
  } else {
    salir("Error al editar sala", -1);
  }
}

?>
