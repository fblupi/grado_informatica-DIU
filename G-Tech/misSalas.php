<?php include 'header.php'; ?>
<section>
<h1>Mis salas<hr></h1>
<article>
<?php
if(!isset($_SESSION['id'])){
  echo '<script>location.href="inicioSesion.php";</script>';
}

include 'libs/myLib.php';
$conn = dbConnect();
$idUsuario = $_SESSION['id'];
$sql = "SELECT * FROM alquiler, sala WHERE alquiler.sala = sala.id AND alquiler.usuario = '$idUsuario';";
$resultado = mysqli_query($conn, $sql);

echo '<table class="table table-condensed">';
echo '<thead>';
echo '<tr>';
echo '<th>Nombre</th>';
echo '<th>Tipo</th>';
echo '<th>Capacidad</th>';
echo '<th>Fecha Inicio</th>';
echo '<th>Fecha Fin</th>';
echo '<th>Acciones</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while($misSalas = mysqli_fetch_assoc($resultado)){
  echo '<tr>';
  echo '<td>';
  echo $misSalas['nombre'];
  echo '</td>';
  echo '<td>';
  if($misSalas['tipo']=='evento'){
    echo 'Evento';
  }else{
    echo 'Empresa';
  }
  echo '</td>';
  echo '<td>';
  echo $misSalas['capacidad'];
  echo '</td>';
  echo '<td>';
  echo date('j F, Y H:i',strtotime($misSalas['fechaInicio']));
  echo '</td>';
  echo '<td>';
  echo date('j F, Y H:i',strtotime($misSalas['fechaFin']));
  echo '</td>';
  echo '<td>';
  echo '<a href="scripts/cancelarReserva?i=';
  echo $misSalas['id'];
  echo '" class="btn btn-danger btnSalasCancelar">Cancelar reserva</a>';
  echo '</td>';
  echo '</tr>';
}

echo '</tbody>';
echo '</table>';

?>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("salas").className = "active menu";
    $('table').stacktable();
}
</script>
<?php include 'footer.php'; ?>
