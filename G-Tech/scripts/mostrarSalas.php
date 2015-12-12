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
$fechaHoraInicio = strtotime($fechaEntrada.' '.$horaEntrada);
$fechaHoraSalida = strtotime($fechaSalida.' '.$horaSalida);
$sqlBusqueda = "SELECT * FROM sala WHERE (sala.nombre LIKE '%$busqueda%' AND sala.capacidad BETWEEN '$capacidadMin' AND '$capacidadMax') AND sala.id NOT IN (SELECT sala FROM alquiler WHERE fechaInicio = '$fechaHoraInicio' OR fechaInicio = '$fechaHoraSalida' OR fechaInicio BETWEEN '$fechaHoraInicio' AND '$fechaHoraSalida');";

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
  echo '<tr>';
  echo '<td>';
  echo $salasDisponibles['nombre'];
  echo '</td>';
  echo '<td>';
  echo $salasDisponibles['tipo'];
  echo '</td>';
  echo '<td>';
  echo $salasDisponibles['capacidad'];
  echo '</td>';
  echo '<td>';
  if($salasDisponibles['tipo']=='evento'){
    echo '<a href="reservarSala?i=';
    echo $salasDisponibles['id'];
    echo '" class="btn btn-info btnSalas">Reservar</a>';
  }else{
    echo '<a href="alquilarSala?i=';
    echo $salasDisponibles['id'];
    echo '" class="btn btn-primary btnSalas">Alquilar</a>';
  }
  echo '</td>';
  echo '</tr>';
}

echo '</tbody>';
echo '</table>';

?>
