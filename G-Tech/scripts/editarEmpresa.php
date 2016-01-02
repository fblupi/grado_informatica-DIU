<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$usuario = $_SESSION['id'];
$empresa = $_POST['empresa'];
$nombre = $_POST['nombre'];
$CIF = $_POST['cif'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$descripcion = $_POST['descripcion'];
$fax = "";
$imagen = "assets/img/empresa.png";

if (!empty($_POST['fax'])) {
  $fax = $_POST['fax'];
}

$conexion = dbConnect();

if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
  $subidaCorrecta = false;
  if ($_FILES['imagen']['error'] > 0) {
    salir2("Ha ocurrido un error en la carga de la imagen", -1, "gestionarEmpresas.php");
  } else {
    $extensiones = array("image/jpg", "image/jpeg", "image/png");
    $limite = 4096;
    if (in_array($_FILES['imagen']['type'], $extensiones) && $_FILES['imagen']['size'] < $limite * 1024) {
      $foldername = "assets/img/empresas";
      $foldermkdir = "../" . $foldername;
      if (!is_dir($foldermkdir)) {
        mkdir($foldermkdir, 0777, true);
      }
      $extension = "." . split("/", $_FILES['imagen']['type'])[1];
      $filename = $empresa . $extension;
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
      $sql = "UPDATE empresa SET CIF='$CIF', nombre='$nombre', direccion='$direccion', telefono='$telefono',
              fax='$fax', descripcion='$descripcion', imagen='$imagen' WHERE id=$empresa";
      $resultado = mysqli_query($conexion, $sql);
      mysqli_close($conexion);
      if ($resultado) {
        salir2("Empresa editada correctamente", 0, "gestionarEmpresas.php");
      } else {
        salir2("Ha ocurrido un error con la imagen", -1, "gestionarEmpresas.php");
      }
    } else { // No se ha subido la imagen
      mysqli_close($conexion);
      salir2("Ha ocurrido un error subiendo la imagen", -1, "gestionarEmpresas.php");
    }
  }
} else { // No hay imagen
  $sql = "UPDATE empresa SET CIF='$CIF', nombre='$nombre', direccion='$direccion', telefono='$telefono',
          fax='$fax', descripcion='$descripcion' WHERE id=$empresa";
  $resultado = mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  if ($resultado) {
    salir2("Empresa editada correctamente", 0, "gestionarEmpresas.php");
  } else {
    salir2("Error al editar empresa", -1, "gestionarEmpresas.php");
  }
}

?>
