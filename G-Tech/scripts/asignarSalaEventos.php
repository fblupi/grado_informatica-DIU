<?php
if(!isset($_SESSION['id'])){
  session_start();
}
include '../libs/myLib.php';
$conn = dbConnect();
$idUsuario = $_SESSION['id'];
$idEvento = $_GET['idEvento'];

$sql = "SELECT fechaInicio, fechaFin, nombre FROM Evento WHERE id = '$idEvento';";
$resultado = mysqli_query($conn, $sql);
$fechas = mysqli_fetch_assoc($resultado);
$fechaInicio = $fechas['fechaInicio'];
$fechaFin = $fechas['fechaFin'];
$nombreEvento = $fechas['nombre'];
echo '<h2>Salas disponibles para '.$nombreEvento.'</h2>';
$sql2 = "SELECT * FROM alquiler, sala WHERE alquiler.sala = sala.id AND alquiler.usuario = '$idUsuario' AND alquiler.tipoSala = 'evento' AND alquiler.asignada = 0 AND fechaInicio >= '$fechaInicio' AND fechaFin <= '$fechaFin';";
$resultado2 = mysqli_query($conn, $sql2);
if(mysqli_num_rows($resultado2)>0){
  echo '<div class="table-responsive">';
  echo '<table class="table table-condensed salasEmpresa" id="salasEmpresa">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>Nombre</th>';
  echo '<th>Tipo</th>';
  echo '<th>Capacidad</th>';
  echo '<th>Acciones</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  while ($misSalas = mysqli_fetch_assoc($resultado2)) {
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
    echo '<button class="btn btn-success btnSalasCancelar" onClick="AsignarSalaEv(';
    echo $misSalas['id'];
    echo ',';
    echo $idEmpresa;
    echo ')">Asignar sala</a>';
    echo '</td>';
    echo '</tr>';
  }
  echo '</tbody>';
  echo '</table>';
  echo '</div>';
}else{
  echo '<div class="alert alert-warning alert-dismissible" role="alert">';
  echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
  echo 'No tiene ninguna sala alquilada, para alquilar una pulse <a href="buscarSalas.php" class="alert-link">aquí</a>';
  echo '</div>';
}
?>
