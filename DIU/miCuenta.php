<?php include 'header.php'; ?>
<section>
<h1 class="section-header">Mi cuenta<hr></hr></h1>
<article>
<?php 
include 'dbConnect.php';
$conn = dbConnect();
$login = $_SESSION['login'];
	
$sql = "SELECT * FROM Usuario WHERE login = '$login'";

$resultado = mysqli_query($conn, $sql);

while($usuario = mysqli_fetch_assoc($resultado)){
	echo '<img class="fotoPerfil" src="';
	echo $usuario['imagen'];
	echo '">';
	echo '<h2 class="nombreUsuario">';
	echo $usuario['login'];
	echo '<a href="#" class="btn btn-default btnperfil">Cambiar contraseña</a>';
	echo '<a href="#" class="btn btn-default btnperfil2">Editar perfil</a>';
	echo '</h2>';
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