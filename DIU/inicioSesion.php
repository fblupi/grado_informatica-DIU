<?php include 'header.php'; ?>
<section class="divInicioSesion">
	<article>
		<form class="form-horizontal" method="POST" action="#" data-toggle="validator" role="form">
			<div class="form-group has-feedback">
				<label>Nombre de usuario</label>
					<input type="text" class="form-control" id="login" name="login" placeholder="Nombre de usuario" required>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
			<div class="form-group has-feedback">
				<label>Contraseña</label>
					<input type="password" class="form-control" id="pass" name="pass" data-minlength="6" placeholder="Contraseña" required>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default inicioSesion">Iniciar Sesión</button>
				</div>
				<small class="izquierda">Si no tienes cuenta, <a href="registro.php">regístrate</a></small>
				<br>
				<small class="izquierda"><a href="recordarPass.php">¿Has olvidado tu contraseña?</a></small>
			</div>
		</form>
	</article>
</section>
<?php include 'footer.php'; ?>