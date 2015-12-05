<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">Empresas
		<?php 
			if(isset($_SESSION['login'])){
				echo '<a href="gestionarEmpresas.php" type="button" class="btn btn-default gestionar"><i class="fa fa-cogs"></i>  Gestionar </a>';
			}
		?><hr></hr></h1>
		<article>
			<form role="search" class="busquedaEmpresas">
          <input type="text" id="busqueda" name="busqueda" onkeyup="MostrarConsultaEmpresas();" class="form-control buscar" placeholder="Buscar...">
				
       </form>
			<div id="todasEmpresas">
			<?php
				include 'libs/myLib.php';
				$conn = dbConnect();

				$sql = "SELECT * FROM Empresa;";

				$resultado = mysqli_query($conn, $sql);

				while ($empresa = mysqli_fetch_assoc($resultado)) {
					echo '<div class="empresas">';
					echo '<img class="logoEmpresa" src="';
					echo $empresa['imagen'];
					echo '">';
					echo '<h2 class="nombreEmpresa">';
					echo $empresa['nombre'];
					echo '</h2>';
					echo '<p class="descripcionEmpresa">';
					echo $empresa['descripcion'];
					echo '</p>';
					echo '<a class="btn btn-default masInfoEmpresa" href="#" role="button">Ver más...</a>';
					echo '</div>';
				}

				?>
</div>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("empresas").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
