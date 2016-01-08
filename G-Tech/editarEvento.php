<?php
	include 'header.php';
	if (!isset($_SESSION['login'])) {
		echo '<script>location.href="inicioSesion.php";</script>';
	}
	$idUsuario = $_SESSION['id'];
	$idEvento = $_GET['i'];
	include_once 'libs/myLib.php';
	$conn = dbConnect();
	$sql = "SELECT * FROM evento WHERE id = '$idEvento';";
	$resultado = mysqli_query($conn, $sql);
	$evento = mysqli_fetch_assoc($resultado);
	$fechaInicio = date('d-m-Y', strtotime($evento['fechaInicio']));
	$horaInicio = date('H:i:s', strtotime($evento['fechaInicio']));
	$fechaFin = date('d-m-Y', strtotime($evento['fechaFin']));
	$horaFin = date('H:i:s', strtotime($evento['fechaFin']));
	$eventoMePertenece = false;
	if ($evento['usuario'] != '') {
		$organizadorUsuario = $evento['usuario'];
		if ($organizadorUsuario == $_SESSION['id']) {
			$eventoMePertenece = true;
		}
	} else {
		$organizadorEmpresa = $evento['empresa'];
		$sql4 = "SELECT usuario.id FROM usuario, empresa WHERE usuario.id = empresa.representante AND empresa.id = '$organizadorEmpresa';";
		$resultado4 = mysqli_query($conn, $sql4);
		$idRepresentante = mysqli_fetch_assoc($resultado4);
		$idRepresentanteEmpresa = $idRepresentante['id'];
		if ($idRepresentanteEmpresa == $_SESSION['id']) {
			$eventoMePertenece = true;
		}
	}
	$sql3 = "SELECT * FROM usuario, usuario_permisos WHERE usuario.id = usuario_permisos.usuario AND usuario.id = '$idUsuario';";
	$resultado3 = mysqli_query($conn, $sql3);
	$permisosAdmin = 0;
	$permisosUser = 0;
	while ($permisos = mysqli_fetch_assoc($resultado3)) {
		$id = $permisos['id'];
		if ($permisos['permiso'] == 1) {
			$permisosAdmin = 1;
		}
		if ($permisos['permiso'] == 2) {
			$permisosUser = 1;
		}
	}
?>
<section>
	<h1 class="section-header">Editar evento
	<hr></hr></h1>
	<article>
		<form id="formularioEditarEvento" method="POST" action="scripts/editarEvento.php" data-toggle="validator" role="form" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 col-lg-6">
					<input type="hidden" name="id" id="id" value="<?php echo $evento['id']; ?>">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Taller de Arduino" value="<?php echo $evento['nombre'];?>" required>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Fecha</label>
								<?php if($evento['sala']!=''){
									echo '<input type="date" id="fechaInicio" name="fechaInicio" class="form-control" value="'.date('Y-m-d', strtotime($fechaInicio)).'" readonly required>';
								}else{
									echo '<input type="date" id="fechaInicio" name="fechaInicio" class="form-control" value="'.date('Y-m-d', strtotime($fechaInicio)).'" required>';
								} ?>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Hora de inicio</label>
								<?php if($evento['sala']!=''){
									echo '<input type="text" id="horaInicio" name="horaInicio" class="form-control" value="'.$horaInicio.'" placeholder="10:00" required readonly>';
								}else{
									echo '<input type="text" id="horaInicio" name="horaInicio" class="form-control" value="'.$horaInicio.'" placeholder="10:00" required>';
								} ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-lg-6">
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="form-group">
								<label>Hora de fin</label>
								<?php if($evento['sala']!=''){
									echo '<input type="text" id="horaFin" name="horaFin" class="form-control" value="'.$horaFin.'" placeholder="12:00" required readonly>';
								}else{
									echo '<input type="text" id="horaFin" name="horaFin" class="form-control" value="'.$horaFin.'" placeholder="12:00" required>';
								} ?>
							</div>
						</div>
					</div>
					<?php if($evento['sala']!=''){
						echo '<span id="helpBlock" class="help-block">';
						echo '* Este evento tiene una sala asignada, primero <a href="#" onclick="DesasignarSalaEvento('.$idEvento.')">desasigne la sala</a> para poder editar la fecha y hora del evento';
						echo '</span>';
					}
					?>

					<div class="form-group">
						<label>Precio (€)</label>
						<input type="number" id="precio" min="0" name="precio" class="form-control" value="<?php echo $evento['precio'];?>" placeholder="20" required>
					</div>
					<div class="form-group">
						<label>Plazas</label>
						<input type="number" id="plazas" min="0" name="plazas" class="form-control" placeholder="20" value="<?php echo $evento['plazas'];?>" required>
					</div>
					<div class="form-group">
						<label>Organizador (Usuario)</label>
						<?php
							$idUsuario = $_SESSION['id'];
							$sqlUsuarioOrganizadorDeEvento = "SELECT usuario FROM evento WHERE id=$idEvento";
							$resultadoUsuarioOrganizadorDeEvento = mysqli_query($conn, $sqlUsuarioOrganizadorDeEvento);
							$usuarioOrganizadorDeEvento = mysqli_fetch_assoc($resultadoUsuarioOrganizadorDeEvento);
							$idOrganizadorDeEvento = $usuarioOrganizadorDeEvento['usuario'];
							$sqlUsuarioOrganizador = "SELECT nombre FROM usuario WHERE id=$idOrganizadorDeEvento";
							$resultadoUsuarioOrganizador = mysqli_query($conn, $sqlUsuarioOrganizador);
							$usuarioOrganizador = mysqli_fetch_assoc($resultadoUsuarioOrganizador);
							if ($evento['usuario'] == '') { // El representante no es el usuario
								if ($eventoMePertenece) { // Si el evento me pertenece
									echo '<select class="form-control" name="usuario" id="usuario">';
									echo '<option value="" selected>No</option>';
									echo '<option value="';
									echo $idUsuario;
									echo '">';
									echo $usuarioOrganizador['nombre'];
									echo '</option>';
								} else { // Si el evento no me pertenece
									echo '<select class="form-control" name="usuario" id="usuario" readonly="true">';
									echo '<option value="">No</option>';
								}
							} else { // El representante es el usuario
								if ($eventoMePertenece) { // Si el evento me pertenece
									echo '<select class="form-control" name="usuario" id="usuario">';
									echo '<option value="">No</option>';
									echo '<option value="';
									echo $idUsuario;
									echo '" selected>';
									echo $usuarioOrganizador['nombre'];
									echo '</option>';
								} else { // Si el evento no me pertenece
									echo '<select class="form-control" name="usuario" id="usuario" readonly="true">';
									echo '<option value="'.$idOrganizadorDeEvento.'">'.$usuarioOrganizador['nombre'].'</option>';
									echo '</select>';
								}
							}
						?>
						</select>
						<span id="helpBlock" class="help-block">
							* Cambiar en caso de que el evento esté organizado por usted
						</span>
					</div>
				</div>
				<div class="col-md-6 col-lg-6">
					<div class="form-group">
						<label>Organizador (Empresa)</label>
						<?php
							$idEmpresa = $evento['empresa'];
							$sqlEmpresaOrganizadora = "SELECT nombre FROM empresa WHERE id='$idEmpresa'";
							$resultadoEmpresaOrganizadora = mysqli_query($conn, $sqlEmpresaOrganizadora);
							$empresaOrganizadora = mysqli_fetch_assoc($resultadoEmpresaOrganizadora);
							if ($evento['empresa'] == '') { // El representante no es la empresa
								if ($eventoMePertenece) { // Si el evento me pertenece
									echo '<select class="form-control" name="empresa" id="empresa">';
									echo '<option value="" selected>No</option>';
									$idUsuario = $_SESSION['id'];
									$sql7 = "SELECT empresa.nombre, empresa.id FROM empresa WHERE representante = '$idUsuario';";
									$resultado7 = mysqli_query($conn, $sql7);
									while($empresasUsuario = mysqli_fetch_assoc($resultado7)){
										echo '<option value="';
										echo $empresasUsuario['id'];
										echo '">';
										echo $empresasUsuario['nombre'];
										echo '</option>';
									}
								} else { // Si el evento no me pertenece
									echo '<select class="form-control" name="empresa" id="empresa" readonly="true">';
									echo '<option value="">No</option>';
								}
							} else { // El representante es la empresa
								if ($eventoMePertenece) { // Si el evento me pertenece
									echo '<select class="form-control" name="empresa" id="empresa">';
									echo '<option value="">No</option>';
									$idUsuario = $_SESSION['id'];
									$sql7 = "SELECT empresa.nombre, empresa.id FROM empresa WHERE representante = '$idUsuario';";
									$resultado7 = mysqli_query($conn, $sql7);
									while($empresasUsuario = mysqli_fetch_assoc($resultado7)){
										echo '<option value="';
										echo $empresasUsuario['id'];
										if ($empresasUsuario['id'] == $evento['empresa']) {
											echo '" selected>';
										} else {
											echo '">';
										}
										echo $empresasUsuario['nombre'];
										echo '</option>';
									}
								} else { // Si el evento no me pertenece
									echo '<select class="form-control" name="empresa" id="empresa" readonly="true">';
									echo '<option value="'.$organizadorEmpresa.'">'.$empresaOrganizadora['nombre'].'</option>';
									echo '</select>';
								}
							}
						?>
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
						<textarea rows="3" id="descripcion" name="descripcion" class="form-control" placeholder="Pequeña descripción del evento..." required><?php echo $evento['descripcion'];?></textarea>
					</div>
					<div class="form-group">
						<label>Requisitos</label>
						<textarea rows="3" id="requisitos" name="requisitos" class="form-control" placeholder="¿Qué se necesita?" required><?php echo $evento['requisitos'];?></textarea>
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-primary btnVolver" onclick="window.history.back();return false;">Volver</button>
			<input type="submit" class="btn btn-default btnCrearSala" value="Editar">
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
