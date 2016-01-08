<?php include 'header.php'; ?>
<section>
<?php
  include_once 'libs/myLib.php';

  $conn = dbConnect();
  $idEvento = $_GET['i'];
  $sql = "SELECT * FROM evento WHERE evento.id = '$idEvento';";

  $resultado = mysqli_query($conn, $sql);

  while ($eventos = mysqli_fetch_assoc($resultado)) {
    $idAlquiler = $eventos['sala'];
    $sql4 = "SELECT nombre FROM alquiler,sala WHERE alquiler.sala = sala.id AND alquiler.id= $idAlquiler;";
    $resultado4 = mysqli_query($conn, $sql4);
    if($resultado4){
      $nombreSala = mysqli_fetch_assoc($resultado4);
    }else{
      $nombreSala = '';
    }

    echo '<h1>';
    echo $eventos['nombre'];
    echo '<hr></h1>';
    echo '<article>';
    echo '<div class="eventos row">';
    echo '<div class="col-md-4 col-lg-4">';
    echo '<img class="logoEventoDetallado" alt="Logo ';
    echo $eventos['nombre'];
    echo '" src="';
    echo $eventos['imagen'];
    echo '"/>';
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
    if($nombreSala==''){
      echo ' Ninguna sala asignada';
    }else{
      echo ' Sala '.$nombreSala['nombre'];
    }
    echo '</p>';
    echo '<p class="organizadorEventoDetallado">';
    $empresa = 0;
    if($eventos['empresa']!=''){
      $empresa = 1;
      $organiza = $eventos['empresa'];
      $sql2 = "SELECT empresa.nombre, empresa.representante FROM empresa WHERE empresa.id = '$organiza';";
      $resultado2 = mysqli_query($conn, $sql2);
      $nombreEmpresa = mysqli_fetch_assoc($resultado2);
      echo '<i class="fa fa-2x fa-university iconoEventoDetallado"></i>';
      echo ' '.$nombreEmpresa['nombre'];
      $representante = $nombreEmpresa['representante'];
    }else if($eventos['usuario']!=''){
      $organiza = $eventos['usuario'];
      $sql2 = "SELECT usuario.nombre FROM usuario WHERE usuario.id = '$organiza';";
      $resultado2 = mysqli_query($conn, $sql2);
      $nombreUsuario = mysqli_fetch_assoc($resultado2);
      echo '<i class="fa fa-2x fa-user iconoEventoDetallado"></i>';
      echo ' '.$nombreUsuario['nombre'];
    }
    echo '</p>';
    echo '</div>';
    echo '<div class="col-md-2 col-lg-2">';
    if($eventos['baja']==0){
      if(isset($_SESSION['id'])) {
        if($empresa==0 && $organiza!=$_SESSION['id']) {
          $login = $_SESSION['id'];
          $sql3 = "SELECT * FROM asistencia WHERE asistencia.usuario = '$login' AND asistencia.evento = '$idEvento';";
          $resultado3 = mysqli_query($conn, $sql3);
          $asiste = mysqli_num_rows($resultado3);
          $sql4 = "SELECT COUNT(*) AS usuariosApuntados FROM asistencia WHERE asistencia.evento = $idEvento;";
          $resultado4 = mysqli_query($conn, $sql4);
          $totalUsuariosApuntados = mysqli_fetch_assoc($resultado4);
          if($eventos['plazas']<=$totalUsuariosApuntados['usuariosApuntados']){
            echo '<input type="button" id="apuntarEvento" class="btn btn-danger btnApuntarseEvento" value="No hay plazas" disabled>';
          }else if($asiste>0){
            echo '<input type="button" id="apuntarEvento" onClick="DesapuntarEvento('.$idEvento.')" class="btn btn-danger btnApuntarseEvento" value="Desapuntarse">';
          }else{
            echo '<input type="button" id="apuntarEvento" onClick="ApuntarEvento('.$idEvento.')" class="btn btn-primary btnApuntarseEvento" value="Apuntarse">';
          }
        }else if($empresa==1){
          if($representante!=$_SESSION['id']){
            $login = $_SESSION['id'];
            $sql3 = "SELECT * FROM asistencia WHERE asistencia.usuario = '$login' AND asistencia.evento = '$idEvento';";
            $resultado3 = mysqli_query($conn, $sql3);
            $asiste = mysqli_num_rows($resultado3);
            $sql4 = "SELECT COUNT(*) AS usuariosApuntados FROM asistencia WHERE asistencia.evento = $idEvento;";
            $resultado4 = mysqli_query($conn, $sql4);
            $totalUsuariosApuntados = mysqli_fetch_assoc($resultado4);
            if($eventos['plazas']<=$totalUsuariosApuntados['usuariosApuntados']){
              echo '<input type="button" id="apuntarEvento" class="btn btn-danger btnApuntarseEvento" value="No hay plazas" disabled>';
            }else if($asiste>0){
              echo '<input type="button" id="apuntarEvento" onClick="DesapuntarEvento('.$idEvento.')" class="btn btn-danger btnApuntarseEvento" value="Desapuntarse">';
            }else{
              echo '<input type="button" id="apuntarEvento" onClick="ApuntarEvento('.$idEvento.')" class="btn btn-primary btnApuntarseEvento" value="Apuntarse">';
            }
          }
        }
      }else{ //SI no estoy identificado
        echo '<a href="inicioSesion.php" id="apuntarEvento" class="btn btn-primary btnApuntarseEvento2">Apuntarse</a>';
        echo '<div class="btnApuntarseEventoDiv">* Para poder apuntarse, es necesario estar identificado en el sistema</div>';
      }
    }
    echo '</div>';
    echo '</div>';
    echo '<div class="row">';
    echo '<p class="descripcionEventoDetallado etiquetaEventoDetallado">Descripción:</p>';
    echo '<p class="descripcionEventoDetallado">';
    echo $eventos['descripcion'];
    echo '</p>';
    echo '<p class="descripcionEventoDetallado etiquetaEventoDetallado">Requisitos:</p>';
    echo '<p class="descripcionEventoDetallado">';
    echo $eventos['requisitos'];
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
