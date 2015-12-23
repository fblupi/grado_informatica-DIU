<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">Nuestras instalaciones
		<?php if(isset($_SESSION['login'])){
		echo '<a href="gestionarSalas.php" type="button" class="btn btn-default gestionar"><i class="fa fa-cogs"></i>  Gestionar </a>';
		}?>
		<hr></hr></h1>
<article>
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

		if($permisosAdmin == 1){
			include 'salasAdmin.php';
		}else if($permisosUser == 1){
			include 'salasUser.php';
		}else{
			include 'salasNoIdentificado.php';
		}
	}else{
		include 'salasNoIdentificado.php';
	}
?>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("salas").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
