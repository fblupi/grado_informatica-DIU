<?php include 'header.php'; ?>
<section>
<h1>Editar sala<hr></h1>
<article>
  <?php
  include 'libs/myLib.php';
  $conn = dbConnect();
  $idSala = $_GET['i'];
  $sql = "SELECT * FROM sala WHERE id = '$idSala';";
  $resultado = mysqli_query($conn, $sql);
  while($sala = mysqli_fetch_assoc($resultado)){
    echo '<form method="POST" action="scripts/editarSala.php" data-toggle="validator" role="form" enctype="multipart/form-data">';
    echo '<div class="row">';
    echo '<div class="col-md-6 col-lg-6">';
    echo '<div class="form-group">';
    echo '<label>Nombre</label>';
    echo '<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Alhambra" value="';
    echo $sala['nombre'];
    echo '">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Capacidad</label>';
    echo '<input type="number" id="capacidad" name="capacidad" class="form-control" value="';
    echo $sala['capacidad'];
    echo '">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Tipo</label>';
    echo '<select class="form-control" name="tipo" id="name">';
    if($sala['tipo']=='evento'){
      echo '<option name="tipo" id="name" value="evento" selected>Evento</option>';
      echo '<option name="tipo" id="name" value="empresa">Empresa</option>';
    }else if($sala['tipo']=='empresa'){
      echo '<option name="tipo" id="name" value="empresa" selected>Empresa</option>';
      echo '<option name="tipo" id="name" value="evento">Evento</option>';
    }else{
      echo '<option name="tipo" id="name" value="evento">Evento</option>';
      echo '<option name="tipo" id="name" value="empresa">Empresa</option>';
    }
    echo '</select>';
    echo '</div>';
    echo '</div>';
    echo '<div class="col-md-6 col-lg-6">';
    echo '<div class="form-group">';
    echo '<label>Planta</label>';
    echo '<input type="number" id="planta" name="planta" class="form-control" value="';
    echo $sala['planta'];
    echo '">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Número</label>';
    echo '<input type="number" id="numero" name="numero" class="form-control" value="';
    echo $sala['numero'];
    echo '">';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label>Imagen</label>';
    echo '<input type="file" class="form-control" id="imagen" name="imagen">';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<input type="submit" class="btn btn-default btnCrearSala" value="Editar">';
    echo '</form>';
  }
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
