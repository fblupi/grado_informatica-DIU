<?php include 'header.php'; ?>
<section>
<?php
  include 'libs/myLib.php';
  $conn = dbConnect();
  $idEvento = $_GET['i'];
  $sql = "SELECT * FROM Evento WHERE Evento.id = '$idEvento';";

  $resultado = mysqli_query($conn, $sql);

  while ($eventos = mysqli_fetch_assoc($resultado)) {
    echo '<h1>';
    echo $eventos['nombre'];
    echo '<hr></h1>';
		echo '<article>';
    echo '<div class="eventos row">';
    echo '<div class="col-md-4 col-lg-4">';
    echo '<img class="logoEventoDetallado" src="';
    echo $eventos['imagen'];
    echo '">';
    echo '</div>';
    echo '<div class="col-md-6 col-lg-6">';
    echo '<p class="fechaEventoDetallado">';
    echo '<i class="fa fa-2x fa-calendar iconoEventoDetallado"></i>';
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
    echo '<p class="precioEventoDetallado">';
    echo '<i class="fa fa-2x fa-money iconoEventoDetallado"></i>';
    echo ' '.$eventos['precio'].' €';
    echo '</p>';
    echo '<p class="salaEventoDetallado"><i class="fa fa-2x fa-arrows iconoEventoDetallado"></i>';
    if($eventos['sala']==''){
      echo ' Ninguna sala asignada';
    }else{
      echo ' Sala '.$eventos['sala'];
    }
    echo '</p>';
    echo '<p class="organizadorEventoDetallado">';
    if($eventos['empresa']!=''){
      $organiza = $eventos['empresa'];
      $sql2 = "SELECT Empresa.nombre FROM Empresa WHERE Empresa.id = '$organiza';";
      $resultado2 = mysqli_query($conn, $sql2);
      $nombreEmpresa = mysqli_fetch_assoc($resultado2);
      echo '<i class="fa fa-2x fa-university iconoEventoDetallado"></i>';
      echo ' '.$nombreEmpresa['nombre'];
    }else if($eventos['usuario']!=''){
      $organiza = $eventos['usuario'];
      $sql2 = "SELECT Usuario.nombre FROM Usuario WHERE Usuario.id = '$organiza';";
      $resultado2 = mysqli_query($conn, $sql2);
      $nombreUsuario = mysqli_fetch_assoc($resultado2);
      echo '<i class="fa fa-2x fa-user iconoEventoDetallado"></i>';
      echo ' '.$nombreUsuario['nombre'];
    }
    echo '</p>';
    echo '</div>';
    echo '<div class="col-md-2 col-lg-2">';
    if(isset($_SESSION['login'])){
      $login = $_SESSION['login'];
      $sql3 = "SELECT * FROM Evento, Usuario, Asistencia WHERE Usuario.id = Asistencia.usuario AND Evento.id = Asistencia.evento AND Usuario.login = '$login' AND Evento.id = '$idEvento';";
      $resultado3 = mysqli_query($conn, $sql3);
      $asiste = mysqli_num_rows($resultado3);
      if($asiste>0){
          echo '<a href="desapuntarEvento.php?i=';
          echo $eventos['id'];
          echo '" class="btn btn-danger btnApuntarseEvento">Desapuntarse</a>';
        }else{
        echo '<a href="apuntarEvento.php?i=';
        echo $eventos['id'];
        echo '" class="btn btn-primary btnApuntarseEvento">Apuntarse</a>';
      }
    }
    echo '</div>';
    echo '</div>';
    echo '<div class="row">';
    echo '<p class="descripcionEventoDetallado etiquetaEventoDetallado">Descripción:</p>';
    echo '<p class="descripcionEventoDetallado">';
    echo $eventos['descripcion'];
    echo '</p>';
    echo '</div>';
    }
?>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("eventos").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
