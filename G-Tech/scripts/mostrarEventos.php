<?php
include_once('../libs/myLib.php');
$conn=dbConnect();
$nombre_filtro = $_GET['search'];

$todosEventos = "SELECT * FROM evento WHERE evento.nombre like '%$nombre_filtro%';";

$result = mysqli_query($conn, $todosEventos);

while ($eventos = mysqli_fetch_assoc($result)) {
  echo '<div class="eventos">';
  echo '<img class="logoEvento" alt="Logo ';
  echo $eventos['nombre'];
  echo '" src="';
  echo $eventos['imagen'];
  echo '">';
  echo '<h2 class="nombreEvento">';
  echo $eventos['nombre'];
  echo '</h2>';
  echo '<p class="fechaEvento">';
  echo '<i class="fa fa-2x fa-calendar iconoFecha"></i>';
  $fechaInicio = explode(" ", $eventos['fechaInicio']);
  $fechaFin = explode(" ", $eventos['fechaFin']);
  $fecha = strtotime($eventos['fechaInicio']);
  $fecha2 = strtotime($eventos['fechaFin']);
  if(strtotime($fechaInicio[0])==strtotime($fechaFin[0])){
    echo ' '.date('j F, Y H:i', $fecha);
    echo ' - '.date('H:i', $fecha2);
  }else{
    echo ' '.date('j F, Y', $fecha);
    echo ' - '.date('j F, Y', $fecha2);
  }
  echo '</p>';
  echo '<p class="descripcionEvento">';
  echo $eventos['descripcion'];
  echo '</p>';
  echo '<a class="btn btn-default masInfoEvento" href="#" role="button">Ver más...</a>';
  if($eventos['precio']==0){
    echo '<span class="label label-success eventoGratuito">Evento gratuito</span>';
  }
  if($eventos['plazas']==0){
    echo '<span class="label label-danger eventoGratuito">No hay plazas</span>';
  }
  echo '</div>';
}
?>
