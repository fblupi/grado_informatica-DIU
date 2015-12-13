<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$conexion = dbConnect();

$CIF = $_POST['CIF'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$fax = "";
$descripcion = $_POST['descripcion'];
$representante = $_POST['representante'];
$imagen = "assets/img/oslugr.png";
$sala = ""; // Las salas entiendo que las cogerá desde la interfaz de registrar empresa que se encargará de recogerlas de la base de datos.


if (!empty($_POST['fax'])) {
  $fax = $_POST['fax'];
}
if (!empty($_POST['sala'])) {
  $sala = $_POST['sala'];
}

$subidaCorrecta = false;
if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
  if ($_FILES['imagen']['error'] > 0) {
    salir("Ha ocurrido un error en la carga de la imagen", -2);
  } else {
    $extensiones = array("image/jpg", "image/jpeg", "image/png");
    $limite = 4096;
    if (in_array($_FILES['imagen']['type'], $extensiones) && $_FILES['imagen']['size'] < $limite * 1024) {
      $foldername = "assets/img/empresa";
      $foldermkdir = "../" . $foldername;
      if (!is_dir($foldermkdir)) {
        mkdir($foldermkdir, 0777, true);
      }
      $extension = "." . split("/", $_FILES['imagen']['type'])[1];
      $filename = $login . $extension;
      $ruta = $foldername . "/" . $filename;
      $rutacrear = $foldermkdir . "/" . $filename;
      if (!file_exists($rutacrear)) {
        $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacrear);
        if ($subidaCorrecta) {
          $imagen = $ruta;
        }
      }
    }
  }
}
$sql = "";
if($imagen != ""){
  $sql = "UPDATE empresa set CIF='$CIF', nombre='$nombre', direccion='$direccion', telefono='$telefono', fax='$fax', descripcion='$descripcion', representante='$representate'";
}
else {
  $sql = "UPDATE empresa set CIF='$CIF', nombre='$nombre', direccion='$direccion', telefono='$telefono', fax='$fax', descripcion='$descripcion', representante='$representate', imagen='$imagen'";
}

$resultado = mysqli_query($conexion, $sql);
mysqli_close($conexion);


if (!$resultado && $subidaCorrecta) {
    unlink($ruta);
    salir("Error al modificar la empresa", -1);
} else {
    salir("La empresa se ha modificado correctamente", 0);
}


?>
