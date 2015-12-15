<?php include 'header.php'; ?>
<section>
<article>
<?php
	if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
include 'libs/myLib.php';
$conn = dbConnect();
$login = $_SESSION['login'];
$id = $_SESSION['id'];

$sql = "SELECT * FROM Usuario WHERE login = '$login'";
$resultado = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM Usuario_Permisos WHERE Usuario_Permisos.usuario = '$id';";
$resultado2 = mysqli_query($conn, $sql2);
$permisosAdmin = 0;
$permisosUser = 0;
while($permisos = mysqli_fetch_assoc($resultado2)){
	if($permisos['permiso']==1){
		$permisosAdmin = 1;
	}
	if($permisos['permiso']==2){
		$permisosUser = 1;
	}
}

while($usuario = mysqli_fetch_assoc($resultado)){
	echo '<div class="miPerfil">';
	echo '<img class="fotoPerfil" src="';
	echo $usuario['imagen'];
	echo '">';
	echo '<h1 class="section-header">Mi perfil ';
	echo '<small>';
	echo $usuario['login'];
	echo '</small>';
	if($permisosAdmin==1){
		echo '<a href="gestionUsuarios.php" class="btn btn-default btnGestionarUsuarios"><i class="fa fa-2x fa-lock"></i> Gestionar permisos</a>';
	}
	echo '<hr></hr></h1>';
	echo '<a href="cambiarPass.php" class="btn btn-default btnperfil">Cambiar contraseña</a>';
	echo '<a href="editarPerfil.php" class="btn btn-default btnperfil2">Editar perfil</a>';
	echo '<p class="datosUsuario">Email: ';
	echo $usuario['email'];
	echo '</p>';
	echo '<p class="datosUsuario">Nombre: ';
	echo $usuario['nombre'];
	echo '</p>';
	echo '<p class="datosUsuario">Teléfono: ';
	echo $usuario['telefono'];
	echo '</p>';
	echo '<p class="datosUsuario">Sexo: ';
	echo $usuario['sexo'];
	echo '</p>';
	echo '<p class="datosUsuario">País: ';
	echo $usuario['pais'];
	echo '</p>';
	echo '<p class="datosUsuario">Localidad: ';
	echo $usuario['localidad'];
	echo '</p>';
	echo '<p class="datosUsuario">Dirección: ';
	echo $usuario['direccion'];
	echo '</p>';
	echo '<p class="datosUsuario">Código postal: ';
	echo $usuario['codigoPostal'];
	echo '</p>';
	echo '</div>';
}

?>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("micuenta").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
