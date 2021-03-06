<?php include 'header.php'; ?>
<section>
		<h1 class="section-header">Empresas
		<?php
			if(isset($_SESSION['login'])){
				if($permisosUser==1 || $permisosAdmin==1){
					echo '<a href="gestionarEmpresas.php" type="button" class="btn btn-default gestionar"><i class="fa fa-cogs"></i>  Gestionar </a>';
				}
			}
		?><hr></hr></h1>
		<article>
			<form role="search" class="busquedaEmpresas">
          <input type="text" id="busqueda" name="busqueda" onkeyup="MostrarConsultaEmpresas();" class="form-control buscar" placeholder="Buscar...">
       </form>
			<div id="todasEmpresas">
			<?php
				include_once 'libs/myLib.php';
				$conn = dbConnect();

				$sql = "SELECT * FROM empresa ORDER BY baja ASC, promocion DESC;";

				$resultado = mysqli_query($conn, $sql);

				while ($empresa = mysqli_fetch_assoc($resultado)) {
					echo '<div class="empresas row">';
					echo '<div class="col-md-12 col-lg-12">';
					echo '<div class="logoEmpresa">';
					echo '<img alt="Logo ';
					echo $empresa['nombre'];
					echo '" src="';
					echo $empresa['imagen'];
					echo '"/>';
					echo '</div>';
					echo '<h2 class="nombreEmpresa">';
					echo $empresa['nombre'];
					echo '</h2>';
					echo '<div class="descripcionEmpresa">';
					echo '<p>';
					echo $empresa['descripcion'];
					echo '</p>';
					echo '<a class="btn btn-default masInfoEmpresa" href="empresa.php?i=';
					echo $empresa['id'];
					echo '" role="button">Ver más...</a>';
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
		document.getElementById("empresas").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
