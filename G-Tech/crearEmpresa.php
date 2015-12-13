<?php include 'header.php';
if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
?>
<section>
		<h1 class="section-header">Crear empresa
		<hr></hr></h1>
		<article>
      <form method="POST" action="scripts/crearEmpresa.php" data-toggle="validator" role="form" enctype="multipart/form-data">
      <div class="row">
      <div class="col-md-6 col-lg-6">
        <div class="form-group">
        <label>Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Feisbuk" class="form-control" required>
        </div>
        <div class="form-group">
        <label>CIF <i class="fa fa-lock"></i></label>
        <input type="text" id="cif" name="cif" class="form-control" placeholder="B12345678" required>
        </div>
        <div class="form-group">
        <label>Dirección</label>
        <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Calle Falsa, 2" required>
        </div>
        <div class="form-group">
        <label>Teléfono</label>
        <input type="text" id="telefono" name="telefono" class="form-control" placeholder="612345678" required>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
				<div class="form-group">
        <label>Fax</label>
        <input type="text" id="fax" name="fax" class="form-control" placeholder="612345678">
        </div>
        <div class="form-group">
        <label>Imagen</label>
        <input type="file" class="form-control" id="imagen" name="imagen">
        </div>
        <div class="form-group">
        <label>Descripción</label>
        <textarea rows="4" id="descripcion" name="descripcion" class="form-control" placeholder="Pequeña descripción de la empresa..." required></textarea>
        </div>
      </div>
      </div>
      <input type="submit" class="btn btn-default btnCrearSala" value="Crear">
    </form>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("empresas").className = "active menu";
		$('table').stacktable();
}
</script>
<?php include 'footer.php'; ?>
