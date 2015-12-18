<?php include 'header.php'; ?>
<section>
<h1>Panel de control del administrador<hr></h1>
<article>
  <a href="crearSala.php" class="btn btn-primary btnAdmin">Añadir sala</a>
<?php
if(!isset($_SESSION['id'])){
  echo '<script>location.href="inicioSesion.php";</script>';
}

include_once 'libs/myLib.php';
$conn = dbConnect();
$idUsuario = $_SESSION['id'];
$sql = "SELECT * FROM sala;";
$resultado = mysqli_query($conn, $sql);

echo '<table class="table table-condensed">';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Nombre</th>';
echo '<th>Tipo</th>';
echo '<th>Capacidad</th>';
echo '<th>Acciones</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while($misSalas = mysqli_fetch_assoc($resultado)){
  echo '<tr>';
  echo '<td>';
  echo $misSalas['id'];
  echo '</td>';
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
  if($misSalas['baja']==0){
    echo '<a href="scripts/bajaSala.php?i=';
    echo $misSalas['id'];
    echo '" class="btn btn-danger btnSalasAdmin">Dar de baja</a>';
  }else{
    echo '<a href="scripts/altaSala.php?i=';
    echo $misSalas['id'];
    echo '" class="btn btn-info btnSalasAdmin">Dar de alta</a>';
  }
  echo '<a href="editarSala.php?i=';
  echo $misSalas['id'];
  echo '" class="btn btn-warning btnSalasAdmin">Editar</a>';
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
