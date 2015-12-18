<?php

include '../libs/myLib.php';
$conn = dbConnect();

$busqueda = $_GET['search'];
$capacidadMin = $_GET['capacidadMin'];
$capacidadMax = $_GET['capacidadMax'];
$fechaEntrada = $_GET['fechaEntrada'];
$fechaSalida = $_GET['fechaSalida'];
$horaEntrada = $_GET['horaEntrada'];
$horaSalida = $_GET['horaSalida'];
$fechaHoraInicio = date('Y-m-d H:i:s', strtotime($fechaEntrada.' '.$horaEntrada));
$fechaHoraSalida = date('Y-m-d H:i:s', strtotime($fechaSalida.' '.$horaSalida));
$sqlBusqueda = "SELECT * FROM sala WHERE (sala.nombre LIKE '%$busqueda%' AND sala.capacidad BETWEEN '$capacidadMin' AND '$capacidadMax') AND sala.id NOT IN (SELECT sala FROM alquiler WHERE (fechaInicio >= '$fechaHoraInicio' AND fechaInicio < '$fechaHoraSalida') OR (fechaFin > '$fechaHoraInicio' AND fechaFin <= '$fechaHoraSalida'));";

$resultado = mysqli_query($conn, $sqlBusqueda);

echo '<table class="table table-condensed">';
echo '<thead>';
echo '<tr>';
echo '<th>Nombre</th>';
echo '<th>Tipo</th>';
echo '<th>Capacidad</th>';
echo '<th>Acciones</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while($salasDisponibles = mysqli_fetch_assoc($resultado)){
  $idSala = $salasDisponibles['id'];
  echo '<tr>';
  echo '<td>';
  echo $salasDisponibles['nombre'];
  echo '</td>';
  echo '<td>';
  if($salasDisponibles['tipo']=='evento'){
    echo 'Evento';
  }else{
    echo 'Empresa';
  }
  echo '</td>';
  echo '<td>';
  echo $salasDisponibles['capacidad'];
  echo '</td>';
  echo '<td>';
  if($salasDisponibles['tipo']=='evento'){
    echo '<button class="btn btn-info btnSalas" onClick="ConfirmarReservar('.$idSala.');return false;">Reservar</button>';
  }else{
    echo '<button class="btn btn-primary btnSalas" onClick="ConfirmarAlquilar('.$idSala.');return false;">Alquilar</button>';
  }
  echo '</td>';
  echo '</tr>';
}
echo '</tbody>';
echo '</table>';

?>
