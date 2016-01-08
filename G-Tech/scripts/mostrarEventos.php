<?php
include_once('../libs/myLib.php');
$conn=dbConnect();
$nombre_filtro = $_GET['search'];
$hoy = date('Y-m-d');
if($nombre_filtro==''){
  $todosEventos = "SELECT * FROM evento WHERE fechaInicio > '$hoy' ORDER BY baja ASC, promocion DESC, fechaInicio ASC;";
}else{
  $todosEventos = "SELECT * FROM evento WHERE evento.nombre like '%$nombre_filtro%';";
}
$result = mysqli_query($conn, $todosEventos);

while ($eventos = mysqli_fetch_assoc($result)) {
  echo '<div class="eventos row">';
  echo '<div class="col-md-12 col-lg-12">';
  echo '<div class="logoEvento">';
  echo '<img alt="Logo ';
  echo $eventos['nombre'];
  echo '" src="';
  echo $eventos['imagen'];
  echo '"/>';
  echo '</div>';
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
  echo '<div class="descripcionEvento">';
  echo '<p>';
  echo $eventos['descripcion'];
  echo '</p>';
  echo '<a class="btn btn-default masInfoEvento" href="evento.php?i=';
  echo $eventos['id'];
  echo '" role="button">Ver más...</a>';
  if($eventos['fechaInicio'] < date('Y-m-d')){
    echo '<span class="label label-danger eventoGratuito">Terminado</span>';
  }
  if($eventos['precio']==0){
    echo '<span class="label label-success eventoGratuito">Gratuito</span>';
  }
  $idEvento = $eventos['id'];
  $sql2 = "SELECT COUNT(*) AS usuariosApuntados FROM asistencia WHERE asistencia.evento = $idEvento;";
  $resultado2 = mysqli_query($conn, $sql2);
  $totalUsuariosApuntados = mysqli_fetch_assoc($resultado2);
  if($eventos['plazas']==$totalUsuariosApuntados['usuariosApuntados']){
    echo '<span class="label label-danger eventoGratuito">No hay plazas</span>';
  }
  if($eventos['baja']==1){
    echo '<span class="label label-danger eventoGratuito">Cancelado</span>';
  }
  echo '</div>';
  echo '</div>';
  echo '</div>';
}
?>
