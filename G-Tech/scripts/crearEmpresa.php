<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$login = $_SESSION['login'];
$usuario = $_SESSION['id'];

$nombre = $_POST['nombre'];
$CIF = $_POST['cif'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$descripcion = $_POST['descripcion'];
$fax = "";
$representante = $usuario;
$imagen = "assets/img/empresa.png";

if (!empty($_POST['fax'])) {
  $fax = $_POST['fax'];
}

$conexion = dbConnect();
$sql = "INSERT INTO empresa (CIF,nombre,direccion,telefono,fax,descripcion,representante,imagen) VALUES ('$CIF','$nombre','$direccion','$telefono','$fax','$descripcion',$representante,'$imagen')";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
  if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
    $subidaCorrecta = false;
    $sql = "SELECT id FROM empresa WHERE id=@@Identity";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($resultado);
    $id = $row['id'];
    if ($_FILES['imagen']['error'] > 0) {
      salir("Ha ocurrido un error en la carga de la imagen", -1);
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
        $filename = $id . $extension;
        $ruta = $foldername . "/" . $filename;
        $rutacrear = $foldermkdir . "/" . $filename;
        if (!file_exists($rutacrear)) {
          $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacrear);
          $imagen = $ruta;
        }
      }
      if ($subidaCorrecta) {
        $sql = "UPDATE empresa SET imagen='$imagen' WHERE id=$id";
        $resultado = mysqli_query($conexion, $sql);
        mysqli_close($conexion);
        if ($resultado) {
          salir("Empresa añadida correctamente", 0);
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
    salir("Empresa añadida correctamente", 0);
  }
} else { // Fallo en INSERT
  mysqli_close($conexion);
  salir("Error añadiendo la empresa", -1);
}

?>
