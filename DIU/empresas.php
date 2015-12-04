<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">Empresas<hr></hr></h1>
		<article>
			<form role="search" class="busquedaEmpresas">
          <input type="text" class="form-control buscar" placeholder="Buscar...">
       </form>
			<div id="todasEmpresas">
			<?php 
				include 'dbConnect.php';
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