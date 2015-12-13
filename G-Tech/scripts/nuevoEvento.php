<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$nombre = $_POST['nombre'];
$fechaInicio= $_POST['fechaInicio'];
$horaInicio = $_POST['horaInicio'];
$fechaFin = $_POST['fechaFin'];
$horaFin = $_POST['horaFin'];
$precio = $_POST['precio'];
$plazas = $_POST['plazas'];
$descripcion = $_POST['descripcion'];
$requisitos = $_POST['requisitos'];
$imagen = "";
$empresa = "NULL";
$usuario = "NULL";

$todoInicio = date('yyyy-mm-dd HH:ii:ss',strtotime($fechaInicio . $horaInicio));
$todoFin = date('yyyy-mm-dd HH:ii:ss',strtotime($fechaFin . $horaFin));
if($_POST['sala']!= "")
  $sala = $_POST['sala'];
if ($_POST['empresa'] != "" && $_POST['usuario'] == "")
  $empresa=$_POST['empresa'];
else if ($_POST['empresa'] == "" && $_POST['usuario'] != "")
  $usuario=$_POST['usuario'];

$conexion = dbConnect();
$sql = "INSERT INTO evento (nombre,fechaInicio,fechaFin,precio,plazas,descripcion,requisitos,empresa,usuario,promocion,baja)
        VALUES ('$nombre','$todoInicio','$todoFin','$precio','$plazas','$descripcion','$requisitos','$empresa','$usuario','$promocion','$baja')";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
  if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
    $subidaCorrecta = false;
    $sql = "SELECT id FROM evento WHERE id=@@Identity";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($resultado);
    $id = $row['id'];
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
        $filename = $id . $extension;
        $ruta = $foldername . "/" . $filename;
        $rutacrear = $foldermkdir . "/" . $filename;
        if (!file_exists($rutacrear)) {
          $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacrear);
          $imagen = $ruta;
        }
      }
      if ($subidaCorrecta) {
        $sql = "UPDATE evento SET imagen='$imagen' WHERE id=$id";
        $resultado = mysqli_query($conexion, $sql);
        mysqli_close($conexion);
        if ($resultado) {
          salir("Evento añadido correctamente", 0);
        } else {
          salir("Ha ocurrido un error con la imagen", -1);
        }
      } else { // No se ha subido la imagen
        mysqli_close($conexion);
        salir("Ha ocurrido un error subiendo la imagen", -1);
      }

    }
  } else { // No hay imagen
    mysqli_close($conexion);
    salir("Evento añadido correctamente", 0);
  }
} else { // Fallo en INSERT
  mysqli_close($conexion);
  salir("Error añadiendo el evento", -1);
}

?>
