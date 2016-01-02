<?php include 'header.php'; ?>
<?php if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
?>
<section class="divInicioSesion">
	<h1 class="section-header">Cambiar contraseña<hr></hr></h1>
<article>
	<form id="formularioCambiarPass" class="form-horizontal" action="javascript:CambiarPass()" method="POST" data-toggle="validator" role="form">
			<div class="form-group has-feedback">
				<label>Contraseña antigua</label>
					<input type="password" class="form-control" id="pass" name="pass" data-minlength="6" required>
			</div>
			<div class="form-group has-feedback">
				<label>Contraseña nueva</label>
					<input type="password" class="form-control" id="newPass" name="newPass" data-minlength="6" required>
			</div>
		<div class="form-group has-feedback">
				<label>Repetir contraseña nueva</label>
					<input type="password" class="form-control" id="newPass2" data-minlength="6" name="newPass2" data-match="#newPass" required>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default inicioSesion">Cambiar contraseña</button>
				</div>
			</div>
		</form>
		<button type="button" class="btn btn-primary btnVolver" onclick="window.history.back();return false;">Volver</button>
</article>
</section>
<?php include 'footer.php'; ?>
