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
include_once 'libs/myLib.php';
$conn = dbConnect();

$sql2 = "SELECT * FROM Usuario;";
$resultado2 = mysqli_query($conn, $sql2);

echo '<div class="table-responsive">';
echo '<table class="table table-condensed salasEmpresa" id="tablaGestionUsuarios">';
echo '<thead>';
echo '<tr>';
echo '<th class="gestionUsuariosIdUsuario">#</th>';
echo '<th class="gestionUsuariosLogin">Login</th>';
echo '<th class="gestionUsuariosNombre">Nombre</th>';
echo '<th class="gestionUsuariosPermisosUsuario">Permisos Usuario</th>';
echo '<th class="gestionUsuariosPermisosAdmin">Permisos Administrador</th>';
echo '<th class="gestionUsuariosBtnModificar">Acciones</th>';
echo '</tr>';
echo '</thead>';
echo '</table>';
while($usuario = mysqli_fetch_assoc($resultado2)){
  $idUsuario = $usuario['id'];
  if($idUsuario!=$_SESSION['id']){
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
    echo '<form id="formularioPermisos'.$idUsuario.'" action="scripts/gestionarPermisos.php" method="POST">';
    echo '<table class="table table-condensed salasEmpresa" id="tablaGestionUsuarios">';
    echo '<tr>';
    echo '<input type="hidden" name="idUsuario" value="'.$idUsuario.'">';
    echo '<td class="gestionUsuariosIdUsuario">';
    echo $usuario['id'];
    echo '</td>';
    echo '<td class="gestionUsuariosLogin">';
    echo $usuario['login'];
    echo '</td>';
    echo '<td class="gestionUsuariosNombre">';
    echo $usuario['nombre'];
    echo '</td>';
    if($permisosUser==1){
      echo '<td class="gestionUsuariosPermisosUsuario">';
      echo '<input type="checkbox" name="permisosUsuario'.$idUsuario.'" id="permisosUsuario'.$idUsuario.'" value="usuario" onClick="CambiarBoton('.$idUsuario.');" checked>';
      echo '</td>';
    }else{
      echo '<td class="gestionUsuariosPermisosUsuario">';
      echo '<input type="checkbox" name="permisosUsuario'.$idUsuario.'" id="permisosUsuario'.$idUsuario.'" value="usuario" onClick="CambiarBoton('.$idUsuario.');">';
      echo '</td>';
    }
    if($permisosAdmin==1){
      echo '<td class="gestionUsuariosPermisosAdmin">';
      echo '<input type="checkbox" name="permisosAdmin'.$idUsuario.'" id="permisosAdmin'.$idUsuario.'" value="admin" onClick="CambiarBoton('.$idUsuario.');" checked>';
      echo '</td>';
    }else{
      echo '<td class="gestionUsuariosPermisosAdmin">';
      echo '<input type="checkbox" name="permisosAdmin'.$idUsuario.'" id="permisosAdmin'.$idUsuario.'" value="admin" onClick="CambiarBoton('.$idUsuario.');">';
      echo '</td>';
    }
    echo '<td class="gestionUsuariosBtnModificar">';
    echo '<button type="button" id="btnModificar'.$idUsuario.'" class="btn btn-default" onClick="CambiarPermisos('.$idUsuario.')">Modificar</button>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';
  }
}
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
