<?php

include_once "dbConnect.php";

$login = $_POST['login'];
$pass = $_POST['pass'];

$conexion = dbConnect();
$sql = "SELECT * FROM usuario WHERE usuario.login='$login'";
$resultado = mysqli_query($conexion, $sql);

if ($row = mysqli_fetch_array($resultado)) {
  if($row['pass'] == $pass) {
    session_start();
    $_SESSION['login'] = $login;
    mysqli_close($conexion);
    echo '<script>
      alert("Se ha iniciado sesión correctamente");
      location.href="'.$_SERVER['HTTP_REFERER'].'";
    </script>';
    return 0;
  }
}

mysqli_close($conexion);
echo '<script>
  alert("El nombre de usuario o la contraseña no son correctos");
  location.href="'.$_SERVER['HTTP_REFERER'].'";
</script>';
return -1;

?>
