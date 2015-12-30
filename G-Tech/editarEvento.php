<?php include 'header.php';
if(!isset($_SESSION['login'])){
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
if($evento['usuario']!=''){
	$organizadorUsuario = $evento['usuario'];
}
if($evento['empresa']!=''){
	$organizadorEmpresa = $evento['empresa'];
	$sql4 = "SELECT Usuario.id FROM Usuario, Empresa WHERE Usuario.id = Empresa.representante AND Empresa.id = '$organizadorEmpresa';";
	$resultado4 = mysqli_query($conn, $sql4);
	$idRepresentante = mysqli_fetch_assoc($resultado4);
	$idRepresentanteEmpresa = $idRepresentante['id'];
}

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

?>
<section>
		<h1 class="section-header">Editar evento
		<hr></hr></h1>
		<article>
      <form method="POST" action="scripts/editarEvento.php" data-toggle="validator" role="form" enctype="multipart/form-data">
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
	        <label>Fecha de inicio</label>
	        <input type="text" id="fechaInicio" name="fechaInicio" class="form-control" value="<?php echo $fechaInicio;?>" placeholder="20-08-2016" required>
	        </div>
				</div>
				<div class="col-md-6 col-lg-6">
	        <div class="form-group">
	        <label>Hora de inicio</label>
	        <input type="text" id="horaInicio" name="horaInicio" class="form-control" value="<?php echo $horaInicio;?>" placeholder="10:00" required>
	        </div>
				</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-lg-6">
        <div class="form-group">
        <label>Fecha de fin</label>
        <input type="text" id="fechaFin" name="fechaFin" class="form-control" value="<?php echo $fechaFin;?>" placeholder="28-08-2016" required>
        </div>
				</div>
				<div class="col-md-6 col-lg-6">
        <div class="form-group">
        <label>Hora de fin</label>
        <input type="text" id="horaFin" name="horaFin" class="form-control" value="<?php echo $horaFin;?>" placeholder="12:00" required>
        </div>
				</div>
			</div>
        <div class="form-group">
        <label>Precio (€)</label>
        <input type="text" id="precio" name="precio" class="form-control" value="<?php echo $evento['precio'];?>" placeholder="20" required>
        </div>
				<div class="form-group">
        <label>Plazas</label>
        <input type="number" id="plazas" name="plazas" class="form-control" placeholder="20" value="<?php echo $evento['plazas'];?>" required>
        </div>
				<div class="form-group">
        <label>Organizador (Usuario)</label>
				<?php if($permisosAdmin==1){
					if($evento['usuario']!=''){
						if($evento['usuario']!= $_SESSION['id']){
							//EL EVENTO NO ES MIO
							echo '<select class="form-control" name="usuario" id="usuario" disabled="true">';
							echo '<option value="">No</option>';
							$idUsuario = $organizadorUsuario;
							$sql5 = "SELECT Usuario.nombre FROM Usuario WHERE Usuario.id = '$idUsuario';";
							$resultado5 = mysqli_query($conn, $sql5);
							while($usuario = mysqli_fetch_assoc($resultado5)){
								echo '<option value="';
								echo $idUsuario;
								echo '" selected>';
								echo $usuario['nombre'];
								echo '</option>';
							}
						}else{
							//EL EVENTO ES MIO
							echo '<select class="form-control" name="usuario" id="usuario">';
							echo '<option value="">No</option>';
							$idUsuario = $organizadorUsuario;
							$sql5 = "SELECT Usuario.nombre FROM Usuario WHERE Usuario.id = '$idUsuario';";
							$resultado5 = mysqli_query($conn, $sql5);
							while($usuario = mysqli_fetch_assoc($resultado5)){
								echo '<option value="';
								echo $idUsuario;
								echo '" selected>';
								echo $usuario['nombre'];
								echo '</option>';
							}
						}
					}else if($idRepresentanteEmpresa==$_SESSION['id']){
						echo '<select class="form-control" name="usuario" id="usuario">';
						echo '<option value="">No</option>';
						$idUsuario = $_SESSION['id'];
						$sql5 = "SELECT Usuario.nombre FROM Usuario WHERE Usuario.id = '$idUsuario';";
						$resultado5 = mysqli_query($conn, $sql5);
						while($usuario = mysqli_fetch_assoc($resultado5)){
							echo '<option value="';
							echo $idUsuario;
							echo '">';
							echo $usuario['nombre'];
							echo '</option>';
						}
					}else{
						echo '<select class="form-control" name="usuario" id="usuario" disabled="true">';
						echo '<option value="">No</option>';
						echo '</select>';
					}

          ?>
        </select>
			<?php }else{ ?>
        <select class="form-control" name="usuario" id="usuario">
					<option value="">No</option>
          <?php
          $idUsuario = $_SESSION['id'];
          $sql6 = "SELECT Usuario.id, Usuario.nombre FROM Usuario WHERE Usuario.id = '$idUsuario';";
          $resultado6 = mysqli_query($conn, $sql6);
          while($usuario = mysqli_fetch_assoc($resultado6)){
            echo '<option value="';
            echo $usuario['id'];
            echo '"';
						if($evento['usuario']==$usuario['id']){
							echo 'selected';
						}
						echo ' >';
            echo $usuario['nombre'];
            echo '</option>';
          }
          ?>
        </select>
        <span id="helpBlock" class="help-block">
          * Cambiar en caso de que el evento esté organizado por usted
        </span>
				<?php } ?>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="form-group">
        <label>Organizador (Empresa)</label>
				<?php if($permisosAdmin==1){
					if($evento['empresa']!=''){
							if($idRepresentanteEmpresa!=$_SESSION['id']){
								//SI EL REPRESENTANTE DE LA EMPRESA NO SOY YO
								echo '<select class="form-control" name="usuario" id="usuario" disabled="true">';
								echo '<option value="">No</option>';
								$idUsuario = $organizadorEmpresa;
								$sql7 = "SELECT Empresa.nombre FROM Empresa WHERE id='$organizadorEmpresa' AND representante = '$idRepresentanteEmpresa';";
								$resultado7 = mysqli_query($conn, $sql7);
								while($empresasUsuario = mysqli_fetch_assoc($resultado7)){
									echo '<option value="';
									echo $organizadorEmpresa;
									echo '" selected>';
									echo $empresasUsuario['nombre'];
			            echo '</option>';
								}
							}else{ //SI EL REPRESENTANTE DE LA EMPRESA SOY YO
								echo '<select class="form-control" name="usuario" id="usuario">';
								echo '<option value="">No</option>';
								$idUsuario = $organizadorEmpresa;
								$sql7 = "SELECT Empresa.nombre, Empresa.id FROM Empresa WHERE representante = '$idRepresentanteEmpresa';";
								$resultado7 = mysqli_query($conn, $sql7);
								while($empresasUsuario = mysqli_fetch_assoc($resultado7)){
									echo '<option value="';
									echo $organizadorEmpresa;
									echo '" selected>';
									echo $empresasUsuario['nombre'];
			            echo '</option>';
								}
							}
						}else if($organizadorUsuario==$_SESSION['id']){
							echo '<select class="form-control" name="usuario" id="usuario">';
							echo '<option value="">No</option>';
							$idUsuario = $_SESSION['id'];
							$sql7 = "SELECT Empresa.nombre, Empresa.id FROM Empresa WHERE representante = '$idUsuario';";
							$resultado7 = mysqli_query($conn, $sql7);
							while($empresasUsuario = mysqli_fetch_assoc($resultado7)){
								echo '<option value="';
								echo $idUsuario;
								echo '" selected>';
								echo $empresasUsuario['nombre'];
								echo '</option>';
							}
						}else{
							echo '<select class="form-control" name="empresa" id="empresa" disabled="true">';
							echo '<option value="">No</option>';
							echo '</select>';
						}
					?>
				</select>
				<?php } else{ ?>
        <select class="form-control" name="empresa" id="empresa" >
					<option value="">No</option>
          <?php
          $sql8 = "SELECT Empresa.nombre, Empresa.id FROM Empresa WHERE representante = '$idUsuario';";
          $resultado8 = mysqli_query($conn, $sql8);
          while($empresasUsuario = mysqli_fetch_assoc($resultado8)){
            echo '<option value="';
            echo $empresasUsuario['id'];
						echo '"';
						if($evento['empresa']==$empresasUsuario['id']){
							echo 'selected';
						}
						echo ' >';
						echo $empresasUsuario['nombre'];
            echo '</option>';
          }
          ?>
          </select>
          <span id="helpBlock" class="help-block">
            * Cambiar en caso de que el evento esté organizado por una de sus empresas
          </span>
				<?php } ?>
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
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("eventos").className = "active menu";
		$('table').stacktable();
}
</script>
<?php include 'footer.php'; ?>
