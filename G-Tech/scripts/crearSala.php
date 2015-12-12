<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$nombre = $_POST['nombre'];
$capacidad = $_POST['capacidad'];
$tipo = $_POST['tipo'];
$planta = $_POST['planta'];
$numero = $_POST['numero'];
$imagen = "assets/img/sala.png";

$conexion = dbConnect();
$sql = "INSERT INTO sala (tipo, nombre, planta, numero, capacidad, imagen, baja)
        VALUES ('$tipo', '$nombre', $planta, $numero, $capacidad, '$imagen', 0)";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
  if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
    $subidaCorrecta = false;
    $sql = "SELECT id FROM sala WHERE id=@@Identity";
    $resultado = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_array($resultado);
    $id = $row['id'];
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
        $filename = $id . $extension;
        $ruta = $foldername . "/" . $filename;
        $rutacrear = $foldermkdir . "/" . $filename;
        if (!file_exists($rutacrear)) {
          $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $rutacrear);
          $imagen = $ruta;
        }
      }
      if ($subidaCorrecta) {
        $sql = "UPDATE sala SET imagen='$imagen' WHERE id=$id";
        $resultado = mysqli_query($conexion, $sql);
        mysqli_close($conexion);
        if ($resultado) {
          salir("Sala añadida correctamente", 0);
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
    salir("Sala añadida correctamente", 0);
  }
} else { // Fallo en INSERT
  mysqli_close($conexion);
  salir("Error añadiendo la sala", -1);
}

?>
