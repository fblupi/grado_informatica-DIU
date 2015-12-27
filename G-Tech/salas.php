<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">Nuestras instalaciones
		<?php if(isset($_SESSION['login'])){
		echo '<a href="gestionarSalas.php" type="button" class="btn btn-default gestionar"><i class="fa fa-cogs"></i>  Gestionar </a>';
		}?>
		<hr></hr></h1>
<article>
<?php
$sql2 = "SELECT * FROM Sala;";
$resultado2 = mysqli_query($conn, $sql2);
$auxEmpresas = Array();
$auxEventos = Array();

while($salas = mysqli_fetch_assoc($resultado2)){
	if($salas['tipo'] == "empresa"){
		array_push($auxEmpresas,$salas);
	}
	if($salas['tipo'] == "evento"){
		array_push($auxEventos,$salas);
	}
}
echo '<h2>Salas para eventos</h2>';

foreach(array_chunk($auxEventos, 3, true) as $salasRow) {
	echo '<div class="row">';
		foreach ($salasRow as $sala) {
			echo '<div class="col-md-4 col-lg-4 sala">';
			echo '<img class="imagenSala" src="';
			echo $sala['imagen'];
			echo '">';
			echo '<h3 class="nombreSala">';
			echo $sala['nombre'];
			echo '</h3>';
			echo '<p>Capacidad: ';
			echo $sala['capacidad'];
			echo ' personas</p>';
			echo '<p>Localización: ';
			echo $sala['planta'];
			echo '.';
			echo $sala['numero'];
			echo '</p>';
			echo '</div>';
		}
	echo '</div>';
}


echo '<h2>Salas para empresas</h2>';

foreach(array_chunk($auxEmpresas, 3, true) as $salasRow) {
	echo '<div class="row">';
		foreach ($salasRow as $sala) {
			echo '<div class="col-md-4 col-lg-4 sala">';
			echo '<img class="imagenSala" src="';
			echo $sala['imagen'];
			echo '">';
			echo '<h3 class="nombreSala">';
			echo $sala['nombre'];
			echo '</h3>';
			echo '<p>Capacidad: ';
			echo $sala['capacidad'];
			echo ' personas</p>';
			echo '<p>Localización: ';
			echo $sala['planta'];
			echo '.';
			echo $sala['numero'];
			echo '</p>';
			echo '</div>';
		}
	echo '</div>';
}
?>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("salas").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
