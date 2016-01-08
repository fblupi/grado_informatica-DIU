<?php include 'header.php';
	if (!isset($_SESSION['login'])) {
		echo '<script>location.href="inicioSesion.php";</script>';
	}
?>
<section>
	<h1 class="section-header">Crear evento
	<hr></hr></h1>
	<article>
		<form id="formularioCrearEvento" method="POST" action="scripts/crearEvento.php" data-toggle="validator" role="form" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Taller de Arduino" required>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Fecha</label>
								<input type="date" id="fechaInicio" name="fechaInicio" class="form-control" placeholder="20-08-2016" required>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Hora de inicio</label>
								<input type="text" id="horaInicio" name="horaInicio" class="form-control" placeholder="10:00" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6">
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Hora de fin</label>
								<input type="text" id="horaFin" name="horaFin" class="form-control" placeholder="12:00" required>
							</div>
						</div>
					</div>
						<div class="form-group">
							<label>Precio (€)</label>
							<input type="number" min="0" id="precio" name="precio" class="form-control" placeholder="20" required>
						</div>
					<div class="form-group">
						<label>Plazas</label>
						<input type="number" min="0" id="plazas" name="plazas" class="form-control" placeholder="20" value="50" required>
					</div>
					<div class="form-group">
						<label>Organizador (Usuario)</label>
						<select class="form-control" name="usuario" id="usuario">
							<?php
								include_once 'libs/myLib.php';
								$conn = dbConnect();
								$idUsuario = $_SESSION['id'];
								$sql3 = "SELECT usuario.id, usuario.nombre FROM usuario WHERE usuario.id = '$idUsuario';";
								$resultado3 = mysqli_query($conn, $sql3);
								while ($usuario = mysqli_fetch_assoc($resultado3)) {
									echo '<option value="';
									echo $usuario['id'];
									echo '">';
									echo $usuario['nombre'];
									echo '</option>';
								}
							?>
							<option value="" selected>No</option>
						</select>
						<span id="helpBlock" class="help-block">
							* Cambiar en caso de que el evento esté organizado por usted
						</span>
					</div>
				</div>
				<div class="col-md-6 col-lg-6">
					<div class="form-group">
						<label>Organizador (Empresa)</label>
						<select class="form-control" name="empresa" id="empresa">
							<?php
								$sql2 = "SELECT empresa.nombre, empresa.id FROM empresa WHERE representante = '$idUsuario';";
								$resultado2 = mysqli_query($conn, $sql2);
								while ($empresasUsuario = mysqli_fetch_assoc($resultado2)) {
									echo '<option value="';
									echo $empresasUsuario['id'];
									echo '">';
									echo $empresasUsuario['nombre'];
									echo '</option>';
								}
							?>
							<option value="" selected>No</option>
						</select>
						<span id="helpBlock" class="help-block">
							* Cambiar en caso de que el evento esté organizado por una de sus empresas
						</span>
					</div>
					<div class="form-group">
						<label>Imagen</label>
						<input type="file" class="form-control" id="imagen" name="imagen">
					</div>
					<div class="form-group">
						<label>Descripción</label>
						<textarea rows="3" id="descripcion" name="descripcion" class="form-control" placeholder="Pequeña descripción del evento..." required></textarea>
					</div>
					<div class="form-group">
						<label>Requisitos</label>
						<textarea rows="3" id="requisitos" name="requisitos" class="form-control" placeholder="¿Qué se necesita?" required></textarea>
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-primary btnVolver" onclick="window.history.back();return false;">Volver</button>
			<input type="submit" class="btn btn-default btnCrearSala" value="Crear">
		</form>
	</article>
</section>
<?php
	mysqli_close($conn);
?>
<script type="text/javascript">
window.onload = function() {
		document.getElementById("eventos").className = "active menu";
		$('table').stacktable();
}
</script>
<?php include 'footer.php'; ?>
