<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">Eventos
			<?php
			if(isset($_SESSION['login'])){
				if($permisosUser==1 || $permisosAdmin==1){
					echo '<a href="gestionarEventos.php" type="button" class="btn btn-default gestionar"><i class="fa fa-cogs"></i>  Gestionar </a>';
				}
			}
		?><hr></hr></h1>
		<article>
			<form role="search" class="busquedaEmpresas">
          <input type="text" id="busqueda" name="busqueda" onkeyup="MostrarConsultaEventos();" class="form-control buscar" placeholder="Buscar...">
       </form>
			<div id="todosEventos">
			<?php
				include_once 'libs/myLib.php';
				$conn = dbConnect();
				$hoy = date('Y-m-d');
				$sql = "SELECT * FROM Evento WHERE fechaInicio > '$hoy' ORDER BY baja ASC, promocion DESC, fechaInicio ASC;";
				$sql5 = "SELECT * FROM Evento WHERE fechaInicio < '$hoy' ORDER BY baja ASC, promocion DESC, fechaInicio ASC;";

				$resultado = mysqli_query($conn, $sql);
				$resultado5 = mysqli_query($conn, $sql5);

				while ($eventos = mysqli_fetch_assoc($resultado)) {
					echo '<div class="eventos row">';
					echo '<div class="col-md-12 col-lg-12">';
					echo '<div class="logoEvento">';
					echo '<img src="';
					echo $eventos['imagen'];
					echo '">';
					echo '</div>';
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
						echo '<span class="label label-success eventoGratuito">Gratuito</span>';
					}
					$idEvento = $eventos['id'];
					$sql2 = "SELECT COUNT(*) AS usuariosApuntados FROM Asistencia WHERE Asistencia.evento = $idEvento;";
					$resultado2 = mysqli_query($conn, $sql2);
					$totalUsuariosApuntados = mysqli_fetch_assoc($resultado2);
					if($eventos['plazas']==$totalUsuariosApuntados['usuariosApuntados']){
						echo '<span class="label label-danger eventoGratuito">No hay plazas</span>';
					}
					if($eventos['baja']==1){
						echo '<span class="label label-danger eventoGratuito">Cancelado</span>';
					}
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
				while ($eventos = mysqli_fetch_assoc($resultado5)) {
					echo '<div class="eventos row">';
					echo '<div class="col-md-12 col-lg-12">';
					echo '<div class="logoEvento">';
					echo '<img src="';
					echo $eventos['imagen'];
					echo '">';
					echo '</div>';
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
					echo '<span class="label label-danger eventoGratuito">Terminado</span>';
					if($eventos['precio']==0){
						echo '<span class="label label-success eventoGratuito">Gratuito</span>';
					}
					$idEvento = $eventos['id'];
					$sql2 = "SELECT COUNT(*) AS usuariosApuntados FROM Asistencia WHERE Asistencia.evento = $idEvento;";
					$resultado2 = mysqli_query($conn, $sql2);
					$totalUsuariosApuntados = mysqli_fetch_assoc($resultado2);
					if($eventos['plazas']==$totalUsuariosApuntados['usuariosApuntados']){
						echo '<span class="label label-danger eventoGratuito">No hay plazas</span>';
					}
					if($eventos['baja']==1){
						echo '<span class="label label-danger eventoGratuito">Cancelado</span>';
					}
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}

				?>
</div>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("eventos").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
