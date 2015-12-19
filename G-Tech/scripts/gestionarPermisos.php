<?php

include_once "../libs/myLib.php";

if(!isset($_SESSION['login'])){
  session_start();
}

if(!isset($_SESSION['login'])){
  echo '<script>location.href="inicioSesion.php";</script>';
}

$idUsuario = $_POST['idUsuario'];

if(isset($_POST['permisosUsuario'.$idUsuario.'']) && $_POST['permisosUsuario'.$idUsuario.'']=='usuario'){
  $permisosUsuario = 1;
}else{
  $permisosUsuario = 0;
}

if(isset($_POST['permisosAdmin'.$idUsuario.'']) && $_POST['permisosAdmin'.$idUsuario.'']=='admin'){
  $permisosAdmin = 1;
}else{
  $permisosAdmin = 0;
}
$conn = dbConnect();

$sql = "SELECT * FROM usuario_permisos WHERE usuario = $idUsuario;";
$resultado = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($resultado);

if($rows==0 && $permisosUsuario == 1){
  $sql4 = "INSERT INTO usuario_permisos (usuario, permiso) VALUES ('$idUsuario', '2');";
  mysqli_query($conn, $sql4);
}
if($rows==0 && $permisosAdmin == 1){
  $sql5 = "INSERT INTO usuario_permisos (usuario, permiso) VALUES ('$idUsuario', '1');";
  mysqli_query($conn, $sql5);
}

if($rows>0){
  while($permisos = mysqli_fetch_assoc($resultado)){
    if($permisos['permiso']==1){
      $admin = 1;
    }
    if($permisos['permiso']==2){
      $user = 1;
    }
  }
  if(!isset($admin) && $permisosAdmin==1){
    $sql6 = "INSERT INTO usuario_permisos (usuario, permiso) VALUES ('$idUsuario', '1');";
    mysqli_query($conn, $sql6);
  }
  if(isset($admin) && $admin == 1 && $permisosAdmin==0){
    $sql2 = "DELETE FROM usuario_permisos WHERE usuario = '$idUsuario' AND permiso = '1';";
    mysqli_query($conn, $sql2);
  }
  if(!isset($user) && $permisosUsuario==1){
    $sql7 = "INSERT INTO usuario_permisos (usuario, permiso) VALUES ('$idUsuario', '2');";
    mysqli_query($conn, $sql7);
  }
  if(isset($user) && $user == 1 && $permisosUsuario==0){
    $sql3 = "DELETE FROM usuario_permisos WHERE usuario = '$idUsuario' AND permiso = '2';";
    mysqli_query($conn, $sql3);
  }
}

salir2("Se han modificado los permisos correctamente", 0, "gestionUsuarios.php");
?>
