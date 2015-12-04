<?php include 'header.php'; ?>
<section>
<article>
	<form class="form-signin" method="POST" action="registrarUsuario.php" data-toggle="validator" role="form" enctype="multipart/form-data">
			<div class="form-group has-feedback">
				<label>Nombre de usuario</label>
				<input type="text" class="form-control" id="login" name="login" placeholder="Nombre de usuario" maxlength="10" required>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
		<div class="form-group has-feedback">
				<label>Email</label>
				<input type="email" pattern="^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$" class="form-control" id="correo" name="correo" placeholder="ejemplo@ejemplo.com" required>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
			<div class="form-group has-feedback">
				<label>Contraseña</label>
				<input type="password" data-minlength="6" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
				<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
		<div class="form-group has-feedback">
				<label>Repetir contraseña</label>
					<input type="password" class="form-control" id="pass2" name="pass2" data-match="#pass" placeholder="Repetir contraseña" required>
					<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			</div>
		<div class="form-group">
				<label>Nombre</label>
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="John Doe">
			</div>
		<div class="form-group">
				<label>Sexo</label>
					<div class="radio">
						<label><input type="radio" name="sexo" value="hombre">Hombre</label><br>
						<label><input type="radio" name="sexo" value="mujer">Mujer</label>
					</div>
			</div>
		<div class="form-group">
				<label>Dirección</label>
					<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle Limonar">
			</div>
		<div class="form-group">
				<label>Localidad</label>
					<input type="text" class="form-control" id="localizacion" name="localizacion" placeholder="Granada">
			</div>
		<div class="form-group">
				<label>País</label>
					<input type="text" class="form-control" id="pais" name="pais" placeholder="España">
			</div>
		<div class="form-group">
				<label>Código postal</label>
					<input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="18001">
			</div>
		<div class="form-group">
				<label>Teléfono</label>
					<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="612345678">
			</div>
		
		<div class="form-group">
				<label>Imagen de perfil</label>
					<input type="file" class="form-control" id="imagen" name="imagen">
		</div>
		<i><small>* Un usuario nuevo no puede reservar ni alquilar salas hasta que no obtiene los permisos para ello. Para eso acudir a recepción.</i></small>

			<div class="form-group">
				<button type="submit" class="btn btn-default inicioSesion">Regístrate</button>
				<small class="izquierda">¿Ya estás registrado?<a href="inicioSesion.php"> Inicia sesión</a></small>
			</div>
		</form>

</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("identificar").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
