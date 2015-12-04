<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">Eventos<hr></hr></h1>
		<article>
			<form role="search" class="busquedaEmpresas">
          <input type="text" class="form-control" placeholder="Buscar...">
       </form>
			<div id="todasEmpresas">
			<?php 
				include 'dbConnect.php';
				$conn = dbConnect();
				
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
					$fecha = strtotime($eventos['fecha']);
					
					echo '  '.date('j F, Y', $fecha);
					echo '</p>';
					echo '<p class="descripcionEvento">';
					echo $eventos['descripcion'];
					echo '</p>';
					echo '<a class="btn btn-default masInfoEvento" href="#" role="button">Ver más...</a>';
					if($eventos['precio']==0){
						echo '<span class="label label-success eventoGratuito">Evento gratuito</span>';
					}
					if($eventos['plazas']==0){
						echo '<span class="label label-danger eventoGratuito">No hay plazas</span>';
					}
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