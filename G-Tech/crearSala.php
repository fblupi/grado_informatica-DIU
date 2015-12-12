<?php include 'header.php'; ?>
<section>
<h1>Añadir sala<hr></h1>
<article>

  <form method="POST" action="scripts/crearSala.php" data-toggle="validator" role="form" enctype="multipart/form-data">
  <div class="row">
  <div class="col-md-6 col-lg-6">
    <div class="form-group">
    <label>Nombre</label>
    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Alhambra">
    </div>
    <div class="form-group">
    <label>Capacidad</label>
    <input type="number" id="capacidad" name="capacidad" class="form-control" value="200">
    </div>
    <div class="form-group">
    <label>Tipo</label>
    <select class="form-control" name="tipo" id="name">
      <option name="tipo" id="name" value="evento">Evento</option>
      <option name="tipo" id="name" value="empresa">Empresa</option>
    </select>
    </div>
  </div>
  <div class="col-md-6 col-lg-6">
    <div class="form-group">
    <label>Planta</label>
    <input type="number" id="planta" name="planta" class="form-control" placeholder="1">
    </div>
    <div class="form-group">
    <label>Número</label>
    <input type="number" id="numero" name="numero" class="form-control" placeholder="1">
    </div>
    <div class="form-group">
    <label>Imagen</label>
    <input type="file" class="form-control" id="imagen" name="imagen">
    </div>
  </div>
  </div>
  <input type="submit" class="btn btn-default btnCrearSala" value="Añadir">
</form>
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
