<?php include 'header.php';
if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
include_once 'libs/myLib.php';
$conn = dbConnect();
$login = $_SESSION['login'];

$sql2 = "SELECT * FROM Usuario, Usuario_Permisos WHERE Usuario.id = Usuario_Permisos.usuario AND Usuario.login = '$login';";
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
?>

<section>
		<h1 class="section-header">Gestionar eventos
			<?php if($permisosUser==1){
				echo '<a href="crearEvento.php" type="button" class="btn btn-primary gestionar">Crear evento</a>';
			} ?>
		<hr></hr></h1>
		<article>
			<?php
				if($permisosAdmin==1 && $permisosUser==1){
					$sql3 = "SELECT * FROM Evento;";
					$resultado3 = mysqli_query($conn, $sql3);
					echo '<div class="table-responsive">';
					echo '<table class="table table-condensed">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Nombre</th>';
					echo '<th>Fecha Inicio</th>';
          echo '<th>Fecha Fin</th>';
					echo '<th>Precio (€)</th>';
					echo '<th>Sala</th>';
          echo '<th>Organizador</th>';
          echo '<th>Acciones</th>';
					echo '</tr>';
					while ($empresa = mysqli_fetch_assoc($resultado3)) {
						$idEmpresa = $empresa['id'];
						echo '<tr>';
						echo '<td>';
						echo $empresa['nombre'];
						echo '</td>';
						echo '<td>';
						echo $empresa['fechaInicio'];
						echo '</td>';
            echo '<td>';
						echo $empresa['fechaFin'];
						echo '</td>';
            echo '<td>';
						echo $empresa['precio'];
						echo '</td>';
						echo '<td>';
						if($empresa['sala']==''){
							echo 'Sin asignar';
						}else{
							echo $empresa['sala'];
						}
						echo '</td>';
            echo '<td>';
            if($empresa['empresa']!=''){
							$idOrganizador = $empresa['empresa'];
							$sql4 = "SELECT Empresa.nombre FROM Empresa WHERE Empresa.id = '$idOrganizador';";
							$resultado4 = mysqli_query($conn, $sql4);
							$nombreOrganizador = mysqli_fetch_assoc($resultado4);
							echo $nombreOrganizador['nombre'];
            }else{
							$idOrganizador = $empresa['usuario'];
							$sql4 = "SELECT Usuario.nombre FROM Usuario WHERE Usuario.id = '$idOrganizador';";
							$resultado4 = mysqli_query($conn, $sql4);
							$nombreOrganizador = mysqli_fetch_assoc($resultado4);
							echo $nombreOrganizador['nombre'];
            }
						echo '</td>';
						echo '<td>';
						if($empresa['baja']==0){
							if($empresa['usuario']!='' && $empresa['usuario']==$_SESSION['id']){
								if($empresa['sala']==''){
									echo '<a type="button" class="btn btn-info accionesEventos" onClick="MostrarSalasDisponiblesEventos('.$idEmpresa.'); return false;">Asignar Sala</a>';
								}else{
									echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/desasignarSalaEvento.php?i=';
									echo $empresa['id'];
									echo '">Desasignar Sala</a>';
								}
								echo '<a type="button" class="btn btn-warning accionesEventos" href="editarEvento.php?i=';
								echo $empresa['id'];
								echo '">Editar</a>';
								echo '<a type="button" class="btn btn-primary accionesEventos" href="verAsistentes.php?i=';
								echo $empresa['id'];
								echo '">Asistentes</a>';
								echo '<a type="button" class="btn btn-success accionesEventos" href="scripts/promocionarEvento.php?i=';
								echo $empresa['id'];
								echo '">Promocionar</a>';

		            echo '<a type="button" class="btn btn-info accionesEventos" href="invitarEvento.php?i=';
								echo $empresa['id'];
								echo '">Invitar</a>';
								echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/cancelarEvento.php?i=';
								echo $empresa['id'];
								echo '">Cancelar</a>';
							}else if($empresa['empresa']!=''){
								$idEvento = $empresa['id'];
								$representante = $_SESSION['id'];
								$sql5 = "SELECT * FROM Evento, Empresa WHERE Evento.id='$idEvento' AND Evento.empresa = Empresa.id AND Empresa.representante = '$representante';";
								$resultado5 = mysqli_query($conn, $sql5);
								$rows = mysqli_num_rows($resultado5);
								if($rows>0){
									if($empresa['sala']==''){
										echo '<a type="button" class="btn btn-info accionesEventos" onClick="MostrarSalasDisponiblesEventos('.$idEmpresa.'); return false;">Asignar Sala</a>';
									}else{
										echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/desasignarSalaEvento.php?i=';
										echo $empresa['id'];
										echo '">Desasignar Sala</a>';
									}
									echo '<a type="button" class="btn btn-warning accionesEventos" href="editarEvento.php?i=';
									echo $empresa['id'];
									echo '">Editar</a>';
									echo '<a type="button" class="btn btn-primary accionesEventos" href="verAsistentes.php?i=';
									echo $empresa['id'];
									echo '">Asistentes</a>';
									echo '<a type="button" class="btn btn-success accionesEventos" href="scripts/promocionarEvento.php?i=';
									echo $empresa['id'];
									echo '">Promocionar</a>';

			            echo '<a type="button" class="btn btn-info accionesEventos" href="invitarEvento.php?i=';
									echo $empresa['id'];
									echo '">Invitar</a>';
									echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/cancelarEvento.php?i=';
									echo $empresa['id'];
									echo '">Cancelar</a>';
								}else{
									echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/cancelarEvento.php?i=';
									echo $empresa['id'];
									echo '">Cancelar</a>';
									echo '<a type="button" class="btn btn-warning accionesEventos" href="editarEvento.php?i=';
									echo $empresa['id'];
									echo '">Editar</a>';
								}
							}else{
							echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/cancelarEvento.php?i=';
							echo $empresa['id'];
							echo '">Cancelar</a>';
							echo '<a type="button" class="btn btn-warning accionesEventos" href="editarEvento.php?i=';
							echo $empresa['id'];
							echo '">Editar</a>';
							}
						}else{
							echo 'EVENTO CANCELADO';
						}
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';
				}else if($permisosAdmin == 1){
					$sql3 = "SELECT * FROM Evento;";
					$resultado3 = mysqli_query($conn, $sql3);
					echo '<div class="table-responsive">';
					echo '<table class="table table-condensed">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Nombre</th>';
					echo '<th>Fecha Inicio</th>';
          echo '<th>Fecha Fin</th>';
					echo '<th>Precio (€)</th>';
					echo '<th>Sala</th>';
          echo '<th>Organizador</th>';
          echo '<th>Acciones</th>';
					echo '</tr>';
					while ($empresa = mysqli_fetch_assoc($resultado3)) {
						echo '<tr>';
						echo '<td>';
						echo $empresa['nombre'];
						echo '</td>';
						echo '<td>';
						echo $empresa['fechaInicio'];
						echo '</td>';
            echo '<td>';
						echo $empresa['fechaFin'];
						echo '</td>';
            echo '<td>';
						echo $empresa['precio'];
						echo '</td>';
						echo '<td>';
						if($empresa['sala']==''){
							echo 'Sin asignar';
						}else{
							echo $empresa['sala'];
						}
						echo '</td>';
            echo '<td>';
            if($empresa['empresa']!=''){
							$idOrganizador = $empresa['empresa'];
							$sql4 = "SELECT Empresa.nombre FROM Empresa WHERE Empresa.id = '$idOrganizador';";
							$resultado4 = mysqli_query($conn, $sql4);
							$nombreOrganizador = mysqli_fetch_assoc($resultado4);
							echo $nombreOrganizador['nombre'];
            }else{
							$idOrganizador = $empresa['usuario'];
							$sql4 = "SELECT Usuario.nombre FROM Usuario WHERE Usuario.id = '$idOrganizador';";
							$resultado4 = mysqli_query($conn, $sql4);
							$nombreOrganizador = mysqli_fetch_assoc($resultado4);
							echo $nombreOrganizador['nombre'];
            }
						echo '</td>';
						echo '<td>';
						if($empresa['baja']==0){
							echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/cancelarEvento.php?i=';
							echo $empresa['id'];
							echo '">Cancelar</a>';
							echo '<a type="button" class="btn btn-warning accionesEventos" href="editarEvento.php?i=';
							echo $empresa['id'];
							echo '">Editar</a>';
						}else{
							echo 'EVENTO CANCELADO';
						}
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';
				}else if($permisosUser == 1){
					$sql3 = "SELECT DISTINCT Evento.id, Evento.nombre, Evento.fechaInicio, Evento.fechaFin, Evento.sala, Evento.precio, Evento.empresa, Evento.usuario, Evento.baja FROM evento, empresa WHERE (evento.empresa = empresa.id AND empresa.representante = '$id') OR (evento.usuario = '$id') AND evento.baja = 0;";
					$resultado3 = mysqli_query($conn, $sql3);
					echo '<div class="table-responsive">';
					echo '<table class="table table-condensed">';
					echo '<thead>';
					echo '<tr>';
					echo '<th>Nombre</th>';
					echo '<th>Fecha Inicio</th>';
          echo '<th>Fecha Fin</th>';
					echo '<th>Precio (€)</th>';
					echo '<th>Sala</th>';
          echo '<th>Organizador</th>';
					echo '<th>Acciones</th>';
					echo '</tr>';
					while ($empresa = mysqli_fetch_assoc($resultado3)) {
						$idEmpresa = $empresa['id'];
						echo '<tr id="'.$idEmpresa.'">';
						echo '<td>';
						echo $empresa['nombre'];
						echo '</td>';
						echo '<td>';
						echo $empresa['fechaInicio'];
						echo '</td>';
            echo '<td>';
						echo $empresa['fechaFin'];
						echo '</td>';
            echo '<td>';
						echo $empresa['precio'];
						echo '</td>';
						echo '<td>';
						if($empresa['sala']==''){
							echo 'Sin asignar';
						}else{
							echo $empresa['sala'];
						}
						echo '</td>';
            echo '<td>';
						if($empresa['empresa']!=''){
							$idOrganizador = $empresa['empresa'];
							$sql4 = "SELECT Empresa.nombre FROM Empresa WHERE Empresa.id = '$idOrganizador';";
							$resultado4 = mysqli_query($conn, $sql4);
							$nombreOrganizador = mysqli_fetch_assoc($resultado4);
							echo $nombreOrganizador['nombre'];
            }else{
							$idOrganizador = $empresa['usuario'];
							$sql4 = "SELECT Usuario.nombre FROM Usuario WHERE Usuario.id = '$idOrganizador';";
							$resultado4 = mysqli_query($conn, $sql4);
							$nombreOrganizador = mysqli_fetch_assoc($resultado4);
							echo $nombreOrganizador['nombre'];
            }
						echo '</td>';
						echo '<td>';
						if($empresa['baja']==0){
							if($empresa['sala']==''){
								echo '<a type="button" class="btn btn-info accionesEventos" onClick="MostrarSalasDisponiblesEventos('.$idEmpresa.'); return false;">Asignar Sala</a>';
							}else{
								echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/desasignarSalaEvento.php?i=';
								echo $empresa['id'];
								echo '">Desasignar Sala</a>';
							}
							echo '<a type="button" class="btn btn-warning accionesEventos" href="editarEvento.php?i=';
							echo $empresa['id'];
							echo '">Editar</a>';
							echo '<a type="button" class="btn btn-primary accionesEventos" href="verAsistentes.php?i=';
							echo $empresa['id'];
							echo '">Asistentes</a>';
							echo '<a type="button" class="btn btn-success accionesEventos" href="scripts/promocionarEvento.php?i=';
							echo $empresa['id'];
							echo '">Promocionar</a>';

	            echo '<a type="button" class="btn btn-info accionesEventos" href="invitarEvento.php?i=';
							echo $empresa['id'];
							echo '">Invitar</a>';
							echo '<a type="button" class="btn btn-danger accionesEventos" href="scripts/cancelarEvento.php?i=';
							echo $empresa['id'];
							echo '">Cancelar</a>';
						}else{
							echo 'EVENTO CANCELADO';
						}
						echo '</td>';
						echo '</tr>';
					}
					echo '</table>';
			}else{
				$sql = "SELECT * FROM Evento;";

				$resultado = mysqli_query($conn, $sql);

				while ($eventos = mysqli_fetch_assoc($resultado)) {
					echo '<div class="eventos">';
					echo '<img class="logoEvento" src="';
					echo $eventos['imagen'];
					echo '">';
					echo '<h2 class="nombreEvento">';
					echo $eventos['nombre'];
					echo '</h2>';
					echo '<p class="fechaEvento">';
					echo '<i class="fa fa-2x fa-calendar iconoFecha"></i>';
					$fechaInicio = explode(" ", $eventos['fechaInicio']);
					$fechaFin = explode(" ", $eventos['fechaFin']);
					$fecha = strtotime($eventos['fechaInicio']);
					$fecha2 = strtotime($eventos['fechaFin']);
					if(strtotime($fechaInicio[0])==strtotime($fechaFin[0])){
						echo ' '.date('j F, Y H:i', $fecha);
						echo ' - '.date('H:i', $fecha2);
					}else{
						echo ' '.date('j F, Y', $fecha);
						echo ' - '.date('j F, Y', $fecha2);
					}
					echo '</p>';
					echo '<div class="descripcionEvento">';
					echo '<p>';
					echo $eventos['descripcion'];
					echo '</p>';
					echo '<a class="btn btn-default masInfoEvento" href="evento.php?i=';
					echo $eventos['id'];
					echo '" role="button">Ver más...</a>';
					if($eventos['precio']==0){
						echo '<span class="label label-success eventoGratuito">Evento gratuito</span>';
					}
					if($eventos['plazas']==0){
						echo '<span class="label label-danger eventoGratuito">No hay plazas</span>';
					}
					echo '</div>';
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
		document.getElementById("eventos").className = "active menu";
		$('table').stacktable();
}
</script>
<?php include 'footer.php'; ?>
