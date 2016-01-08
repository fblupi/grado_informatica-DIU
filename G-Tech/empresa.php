<?php include 'header.php'; ?>
<section>
	<h1 class="section-header">Empresa
    <hr></hr></h1>
	<article>
	<?php
		include_once 'libs/myLib.php';
        $conn = dbConnect();
        $idEmpresa = $_GET['i'];
        $sql = "SELECT Empresa.imagen, Empresa.nombre, Empresa.descripcion, Empresa.sala, Empresa.direccion, Empresa.telefono, Empresa.fax, Usuario.login, Usuario.email FROM Empresa, Usuario WHERE Empresa.representante = Usuario.id AND Empresa.id = '$idEmpresa';";
        $resultado = mysqli_query($conn, $sql);

		while ($empresa = mysqli_fetch_assoc($resultado)) {
			$idAlquiler = $empresa['sala'];
			$sql2 = "SELECT nombre, fechaInicio, fechaFin FROM alquiler, sala WHERE alquiler.sala = sala.id AND alquiler.id= $idAlquiler;";
			$resultado2 = mysqli_query($conn, $sql2);
			if($resultado2){
				$infoSala = mysqli_fetch_assoc($resultado2);
			}else{
				$infoSala = '';
			}

			echo '<div class="empresas">';
			echo '<img class="logoEmpresa" alt="Logo ';
			echo $empresa['nombre'];
			echo '" src="';
			echo $empresa['imagen'];
			echo '"/>';
			echo '<h2 class="nombreEmpresa">';
			echo $empresa['nombre'];
			echo '</h2>';
			echo '<div class="descripcionEmpresa">';
			echo '<p>';
			echo $empresa['descripcion'];
			echo '</p>';
			echo '<p><i class="fa fa-2x fa-home etiquetasEmpresa"></i>';
			echo $empresa['direccion'];
			echo '</p>';
			echo '<p><i class="fa fa-2x fa-arrows etiquetasEmpresa"></i>';

			if ($infoSala=='') {
				echo 'Ninguna sala asignada';
			} else {
				$hoy = date('Y-m-d H:i:s');
				if ($infoSala['fechaInicio'] <= $hoy && $infoSala['fechaFin'] >= $hoy) {
					echo 'Sala '.$infoSala['nombre'];
				} else {
					echo 'Ninguna sala asignada';
				}
			}

			echo '</p>';
			echo '<p><i class="fa fa-2x fa-phone etiquetasEmpresa"></i>';
			echo $empresa['telefono'];
			echo '</p>';
			echo '<p><i class="fa fa-2x fa-fax etiquetasEmpresa"></i>';
			echo $empresa['fax'];
			echo '</p>';
			echo '<p><i class="fa fa-2x fa-envelope etiquetasEmpresa"></i>';
			echo '<a href="mailto:';
			echo $empresa['email'];
			echo '?Subject=Consulta">';
			echo $empresa['login'];
			echo '</a>';
			echo '</p>';
			echo '</div>';
			echo '</div>';
		}

	?>
	</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("empresas").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
