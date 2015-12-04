<?php

include_once "dbConnect.php";

if (!isset($_SESSION['login'])) {
    session_start();
}

$login = $_POST['login'];
$pass = $_POST['pass'];
$email = $_POST['correo'];
$nombre = "";
$telefono = "";
$sexo = "";
$pais = "";
$localidad = "";
$direccion = "";
$codigoPostal = "";
$imagen = "assets/img/usuario.png";

if (!empty($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}

if (!empty($_POST['telefono'])) {
  $nombre = $_POST['telefono'];
}

if (!empty($_POST['sexo'])) {
  $nombre = $_POST['sexo'];
}

if (!empty($_POST['pais'])) {
  $nombre = $_POST['pais'];
}

if (!empty($_POST['localidad'])) {
  $nombre = $_POST['localidad'];
}

if (!empty($_POST['direccion'])) {
  $nombre = $_POST['direccion'];
}

if (!empty($_POST['codigoPostal'])) {
  $nombre = $_POST['codigoPostal'];
}

$subidaCorrecta = false;
if (isset($_FILES['imagen'])) {
  if ($_FILES['imagen']['error'] > 0) {
    salir("Ha ocurrido un error en la carga de la imagen", -2);
  } else {
    $extensiones = array("image/jpg", "image/jpeg", "image/png");
    $limite = 2048;
    if (in_array($_FILES['imagen']['type'], $extensiones) && $_FILES['imagen']['size'] < $limite * 1024) {
      $foldername = "assets/img/users";
      if (!is_dir($foldername)) {
        mkdir($foldername);
      }
      $extension = "." . split("/", $_FILES['imagen']['type'])[1];
      $filename = $login . $extension;
      $ruta = $foldername . "/" . $filename;
      if (!file_exists($ruta)) {
        $subidaCorrecta = @move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
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
mysqli_close($conexion);

if (!$resultado && $subidaCorrecta) {
  unlink($ruta);
  salir("El usuario ya existe", -1);
} else {
  $_SESSION['login'] = $login;
  salir("Se ha registrado correctamente", 0);
}


function salir($message, $code) {
  echo '<script>
    alert("' . $message . '");
    location.href= " ' . $_SERVER['HTTP_REFERER'] . '";
  </script>';
  return $code;
}

?>
