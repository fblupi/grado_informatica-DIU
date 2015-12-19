<?php include 'header.php';
if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
include_once 'libs/myLib.php';
$conn = dbConnect();
$idEvento = $_GET['i'];
$sql = "SELECT Evento.nombre FROM Evento WHERE id= '$idEvento';";
$resultado = mysqli_query($conn, $sql);
$nombreEvento = mysqli_fetch_assoc($resultado);
$sql3 = "SELECT * FROM asistencia, usuario WHERE asistencia.usuario = usuario.id AND asistencia.evento = '$idEvento';";
$resultado3 = mysqli_query($conn, $sql3);
?>

<section>
		<h1 class="section-header">Asistentes
      <small><?php echo $nombreEvento['nombre']; ?></small>
		<hr></hr></h1>
		<article>
			<?php
			echo '<table class="table table-condensed">';
			echo '<thead>';
			echo '<tr>';
			echo '<th>Nombre</th>';
      echo '<th>Foto</th>';
      echo '<th>Email</th>';
			echo '<th>Teléfono</th>';
      echo '<th>Dirección</th>';
			echo '</tr>';
      while ($evento = mysqli_fetch_assoc($resultado3)) {
  			echo '<tr>';
  			echo '<td>';
  			echo $evento['nombre'];
  			echo '</td>';
        echo '<td>';
        echo '<img class="fotoAsistente" src="';
        echo $evento['imagen'];
        echo '">';
        echo '</td>';
        echo '<td>';
  			echo $evento['email'];
  			echo '</td>';
        echo '<td>';
  			echo $evento['telefono'];
  			echo '</td>';
        echo '<td>';
  			echo $evento['direccion'].' ('.$evento['localidad'].')';
  			echo '</td>';
  			echo '</tr>';
    }

				?>
			</table>
				<button type="button" class="btn btn-primary btnVolver" onclick="window.history.back();return false;">Volver</button>
</div>
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
