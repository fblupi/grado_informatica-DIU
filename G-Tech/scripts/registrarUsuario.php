<?php

include_once "../libs/myLib.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$login = $_POST['login'];
$pass = md5($_POST['pass']);
$email = $_POST['correo'];
$nombre = "";
$telefono = "";
$sexo = "";
$pais = "";
$localidad = "";
$direccion = "";
$codigoPostal = "";
$imagen = "assets/img/user.png";

if (!empty($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}

if (!empty($_POST['telefono'])) {
  $telefono = $_POST['telefono'];
}

if (!empty($_POST['sexo'])) {
  $sexo = $_POST['sexo'];
}

if (!empty($_POST['pais'])) {
  $pais = $_POST['pais'];
}

if (!empty($_POST['localizacion'])) {
  $localidad = $_POST['localizacion'];
}

if (!empty($_POST['direccion'])) {
  $direccion = $_POST['direccion'];
}

if (!empty($_POST['codigoPostal'])) {
  $codigoPostal = $_POST['codigoPostal'];
}

$subidaCorrecta = false;
if (isset($_FILES['imagen']) && $_FILES['imagen']['name']) {
  if ($_FILES['imagen']['error'] > 0) {
    salir2("Ha ocurrido un error en la carga de la imagen", -1, "registro.php");
  } else {
    $extensiones = array("image/jpg", "image/jpeg", "image/png");
    $limite = 4096;
    if (in_array($_FILES['imagen']['type'], $extensiones) && $_FILES['imagen']['size'] < $limite * 1024) {
      $foldername = "assets/img/users";
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

$conexion = dbConnect();
$sql = "INSERT INTO usuario (login, pass, email, nombre, telefono, sexo, pais, localidad, direccion, codigoPostal, imagen)
        VALUES ('" . $login . "', '" . $pass . "', '" . $email . "', '" . $nombre . "', '" . $telefono . "', '" . $sexo . "',
        '" . $pais . "', '" . $localidad . "', '" . $direccion . "', '" . $codigoPostal . "', '" . $imagen . "');";
$resultado = mysqli_query($conexion, $sql);
$sql2 = "SELECT id FROM usuario WHERE login='$login'";
$resultado2 = mysqli_query($conexion, $sql2);
$row = mysqli_fetch_array($resultado2);
mysqli_close($conexion);

if (!$resultado && $subidaCorrecta) {
  unlink($ruta);
  salir2("El usuario ya existe", -1, "registro.php");
} else {
  $_SESSION['login'] = $login;
  $_SESSION['id'] = $row['id'];
  salir2("Se ha registrado correctamente", 0, "index.php");
}

?>
