<?php include 'header.php';
if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
?>
<section>
		<h1 class="section-header">Gestionar empresas
		<a href="crearEmpresa.php" type="button" class="btn btn-primary gestionar">Crear empresa</a>
		<hr></hr></h1>
		<article>
			<?php
				include_once 'libs/myLib.php';
				$conn = dbConnect();
				$login = $_SESSION['login'];

				$sql2 = "SELECT * FROM usuario, usuario_permisos WHERE usuario.id = usuario_permisos.usuario AND usuario.login = '$login';";
				$resultado2 = mysqli_query($conn, $sql2);
				$permisosAdmin = 0;
				$permisosUser = 0;
				while($permisos = mysqli_fetch_assoc($resultado2)){
					$id = $permisos['id'];
					if($permisos['permiso']==1){
						$permisosAdmin = 1;
					}
					if($permisos['permiso']==2){
						$permisosUser = 1;
					}
				}

				if($permisosAdmin==1 && $permisosUser==1){
					$sql3 = "SELECT * FROM empresa;";
					$resultado3 = mysqli_query($conn, $sql3);
					echo '<table class="table table-condensed">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Nombre</th>';
					echo '<th>CIF</th>';
					echo '<th>Sala</th>';
					echo '<th>Acciones</th>';
					echo '</tr>';
					while ($empresa = mysqli_fetch_assoc($resultado3)) {
						$idEmpresa = $empresa['id'];
						echo '<tr>';
						echo '<td>';
						echo $empresa['nombre'];
						echo '</td>';
						echo '<td>';
						echo $empresa['CIF'];
						echo '</td>';
						echo '<td>';
						if($empresa['sala']==''){
							echo 'Sin asignar';
						}else{
							echo $empresa['sala'];
						}
						echo '</td>';
						echo '<td>';
						echo '<a type="button" class="btn btn-warning acciones" href="editarEmpresa.php?i=';
						echo $empresa['id'];
						echo '">Editar</a>';
						if($empresa['baja']==0){
							echo '<input type="button" onClick="BajaEmpresa('.$empresa['id'].')" class="btn btn-danger acciones" value="Dar de baja">';
						}else{
							echo '<input type="button" onClick="AltaEmpresa('.$empresa['id'].')" class="btn btn-info acciones" value="Dar de alta">';
						}
						if($empresa['representante']==$_SESSION['id']){
							echo '<input type="button" onClick="PromocionarEmpresa('.$empresa['id'].')" class="btn btn-success acciones" value="Promocionar">';
							if($empresa['sala']==''){
								echo '<button class="btn btn-info acciones" onClick="MostrarSalasDisponiblesEmpresas('.$idEmpresa.'); return false;">Asignar Sala</button>';
							}else{
								echo '<input type="button" class="btn btn-danger acciones" onclick="DesasignarSalaEmpresa('.$empresa['id'].')" value="Desasignar Sala">';
							}
						}
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';
				}else if($permisosAdmin == 1){
					$sql3 = "SELECT * FROM empresa;";
					$resultado3 = mysqli_query($conn, $sql3);
					echo '<table class="table table-condensed">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Nombre</th>';
					echo '<th>CIF</th>';
					echo '<th>Sala</th>';
					echo '<th>Acciones</th>';
					echo '</tr>';
					while ($empresa = mysqli_fetch_assoc($resultado3)) {
						echo '<tr>';
						echo '<td>';
						echo $empresa['nombre'];
						echo '</td>';
						echo '<td>';
						echo $empresa['CIF'];
						echo '</td>';
						echo '<td>';
						if($empresa['sala']==''){
							echo 'Sin asignar';
						}else{
							echo $empresa['sala'];
						}
						echo '</td>';
						echo '<td>';
						echo '<a type="button" class="btn btn-warning acciones" href="editarEmpresa.php?i=';
						echo $empresa['id'];
						echo '">Editar</a>';
						if($empresa['baja']==0){
							echo '<input type="button" onClick="BajaEmpresa('.$empresa['id'].')" class="btn btn-danger acciones" value="Dar de baja">';
						}else{
							echo '<input type="button" onClick="AltaEmpresa('.$empresa['id'].')" class="btn btn-info acciones" value="Dar de alta">';
						}
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';
				}else if($permisosUser == 1){
					$sql3 = "SELECT * FROM empresa WHERE representante = '$id';";
					$resultado3 = mysqli_query($conn, $sql3);
					echo '<table class="table table-condensed" id="testingTable1">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Nombre</th>';
					echo '<th>CIF</th>';
					echo '<th>Sala</th>';
					echo '<th>Acciones</th>';
					echo '</thead>';
					echo '</tr>';

					while ($empresa = mysqli_fetch_assoc($resultado3)) {
						$idEmpresa = $empresa['id'];
						echo '<tr id="'.$idEmpresa.'">';
						echo '<td>';
						echo $empresa['nombre'];
						echo '</td>';
						echo '<td>';
						echo $empresa['CIF'];
						echo '</td>';
						echo '<td>';
						echo $empresa['sala'];
						echo '</td>';
						echo '<td>';
						if($empresa['baja']==0){
							echo '<input type="button" onClick="BajaEmpresa('.$empresa['id'].')" class="btn btn-danger acciones" value="Dar de baja">';
						}else{
							echo '<input type="button" onClick="AltaEmpresa('.$empresa['id'].')" class="btn btn-info acciones" value="Dar de alta">';
						}
						echo '<a type="button" class="btn btn-warning acciones" href="editarEmpresa.php?i=';
						echo $empresa['id'];
						echo '">Editar</a>';
						echo '<input type="button" onClick="PromocionarEmpresa('.$empresa['id'].')" class="btn btn-success acciones" value="Promocionar">';
						if($empresa['sala']==''){
							echo '<button class="btn btn-info acciones" onClick="MostrarSalasDisponiblesEmpresas('.$idEmpresa.'); return false;">Asignar Sala</button>';
						}else{
							echo '<input type="button" class="btn btn-danger acciones" onclick="DesasignarSalaEmpresa('.$empresa['id'].')" value="Desasignar Sala">';
						}
						echo '</td>';
						echo '</tr>';
						echo '<tr id="resultadoEscondido'.$idEmpresa.'" class="resultadoEscondido">';
						echo '<td colspan="4" id="resultado'.$idEmpresa.'"></td>';
						echo '</tr>';
					}
					echo '</table>';
				}else{

				$sql = "SELECT * FROM empresa;";

				$resultado = mysqli_query($conn, $sql);

					while ($empresa = mysqli_fetch_assoc($resultado)) {
						echo '<div class="empresas">';
						echo '<img class="logoEmpresa" alt="Logo ';
						echo $empresa['nombre'];
						echo '" src="';
						echo $empresa['imagen'];
						echo '"/>';
						echo '<h2 class="nombreEmpresa">';
						echo $empresa['nombre'];
						echo '</h2>';
						echo '<p class="descripcionEmpresa">';
						echo $empresa['descripcion'];
						echo '</p>';
						echo '<a class="btn btn-default masInfoEmpresa" href="#" role="button">Ver más...</a>';
						echo '</div>';
					}
				}
				?>
</div>
<button type="button" class="btn btn-primary btnVolver" onclick="window.history.back();return false;">Volver</button>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("empresas").className = "active menu";
		$('table').stacktable();
}
</script>
<?php include 'footer.php'; ?>
