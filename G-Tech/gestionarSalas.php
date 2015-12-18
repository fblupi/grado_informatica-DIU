<?php include 'header.php'; ?>
<section>
  <h1>Gestionar salas<hr></h1>
<article><center>
<?php
include_once 'libs/myLib.php';
$conn = dbConnect();

if(isset($_SESSION['login'])){
  $login = $_SESSION['login'];
  $sql = "SELECT * FROM Usuario, Usuario_Permisos WHERE Usuario.id = Usuario_Permisos.usuario AND Usuario.login = '$login';";
  $resultado = mysqli_query($conn, $sql);
  $permisosAdmin = 0;
  $permisosUser = 0;
  while($permisos = mysqli_fetch_assoc($resultado)){
    if($permisos['permiso']==1){
      $permisosAdmin = 1;
    }
    if($permisos['permiso']==2){
      $permisosUser = 1;
    }
  }
  if($permisosAdmin==1 && $permisosUser==0){
    echo '<a href="gestionSalasAdmin.php" class="btn btn-default btnGestionarSala"><i class="fa fa-2x fa-lock"></i> Opciones del administrador</a>';
  } else if($permisosAdmin==1 && $permisosUser==1) {
    echo '<a href="buscarSalas.php" class="btn btn-default btnGestionarSala"><i class="fa fa-2x fa-search"></i> Buscar</a>';
    echo '<a href="misSalas.php" class="btn btn-default btnGestionarSala"><i class="fa fa-2x fa-cog"></i> Mis salas</a>';
    echo '<a href="gestionSalasAdmin.php" class="btn btn-default btnGestionarSala"><i class="fa fa-2x fa-lock"></i> Opciones del administrador</a>';
  } else {
    echo '<a href="buscarSalas.php" class="btn btn-default btnGestionarSala"><i class="fa fa-2x fa-search"></i> Buscar</a>';
    echo '<a href="misSalas.php" class="btn btn-default btnGestionarSala"><i class="fa fa-2x fa-cog"></i> Mis salas</a>';
  }
}
?>
</center>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("salas").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
