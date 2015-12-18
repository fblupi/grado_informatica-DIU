<?php include 'header.php'; ?>
<section>
  <h1 class="section-header">Gestionar permisos</h1>
<article>
<form role="search" class="busquedaEmpresas">
    <input type="text" id="busqueda" name="busqueda" onkeyup="MostrarConsultaEmpresas();" class="form-control buscar" placeholder="Buscar...">
 </form>
<div id="todosUsuarios">
<?php
	if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
include 'libs/myLib.php';
$conn = dbConnect();

$sql2 = "SELECT * FROM Usuario;";
$resultado2 = mysqli_query($conn, $sql2);

echo '<div class="table-responsive">';
echo '<table class="table table-condensed salasEmpresa" id="tablaGestionUsuarios">';
echo '<thead>';
echo '<tr>';
echo '<th>#</th>';
echo '<th>Login</th>';
echo '<th>Nombre</th>';
echo '<th>Permisos Usuario</th>';
echo '<th>Permisos Administrador</th>';
echo '<th>Acciones</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
while($usuario = mysqli_fetch_assoc($resultado2)){
  $idUsuario = $usuario['id'];
  $sql3 = "SELECT * FROM Usuario, Usuario_Permisos WHERE Usuario.id = Usuario_Permisos.usuario AND Usuario.id = '$idUsuario';";
  $resultado3 = mysqli_query($conn, $sql3);
  $permisosAdmin = 0;
  $permisosUser = 0;
  while($permisos = mysqli_fetch_assoc($resultado3)){
  	$id = $permisos['id'];
  	if($permisos['permiso']==1){
  		$permisosAdmin = 1;
  	}
  	if($permisos['permiso']==2){
  		$permisosUser = 1;
  	}
  }
  echo '<tr>';
  echo '<form action="scripts/gestionarPermisos.php?i='.$idUsuario.'" method="POST">';
  echo '<input type="hidden" name="idUsuario" value="'.$idUsuario.'">';
  echo '<td>';
  echo $usuario['id'];
  echo '</td>';
  echo '<td>';
  echo $usuario['login'];
  echo '</td>';
  echo '<td>';
  echo $usuario['nombre'];
  echo '</td>';
  if($permisosUser==1){
    echo '<td>';
    echo '<input type="checkbox" name="permisosUsuario'.$idUsuario.'" id="permisosUsuario'.$idUsuario.'" value="usuario" onClick="CambiarBoton('.$idUsuario.');" checked>';
    echo '</td>';
  }else{
    echo '<td>';
    echo '<input type="checkbox" name="permisosUsuario'.$idUsuario.'" id="permisosUsuario'.$idUsuario.'" value="usuario" onClick="CambiarBoton('.$idUsuario.');">';
    echo '</td>';
  }
  if($permisosAdmin==1){
    echo '<td>';
    echo '<input type="checkbox" name="permisosAdmin'.$idUsuario.'" id="permisosAdmin'.$idUsuario.'" value="admin" onClick="CambiarBoton('.$idUsuario.');" checked>';
    echo '</td>';
  }else{
    echo '<td>';
    echo '<input type="checkbox" name="permisosAdmin'.$idUsuario.'" id="permisosAdmin'.$idUsuario.'" value="admin" onClick="CambiarBoton('.$idUsuario.');">';
    echo '</td>';
  }
  echo '<td>';
  echo '<input type="submit" id="btnModificar'.$idUsuario.'" class="btn btn-default" value="Modificar">';
  echo '</td>';
  echo '</form>';
  echo '</tr>';
}

echo '</tbody>';
echo '</table>';

?>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
    $('#tablaGestionUsuarios').stacktable();
}
</script>
<?php include 'footer.php'; ?>
