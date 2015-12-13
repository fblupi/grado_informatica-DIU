<?php include 'header.php';
if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
?>
<section>
		<h1 class="section-header">Editar empresa
		<hr></hr></h1>
		<article>
      <?php
      include 'libs/myLib.php';
      $conn = dbConnect();
      $idEmpresa = $_GET['i'];
      $sql = "SELECT * FROM Empresa WHERE id = '$idEmpresa';";
      $idUsuario = $_SESSION['id'];
      $resultado = mysqli_query($conn, $sql);

      while($empresa = mysqli_fetch_assoc($resultado)){ ?>
        <form method="POST" action="scripts/editarEmpresa.php" data-toggle="validator" role="form" enctype="multipart/form-data">
        <div class="row">
        <div class="col-md-6 col-lg-6">
					<input type="hidden" name="empresa" value="<?php echo $empresa['id']; ?>">
          <div class="form-group">
          <label>Nombre</label>
          <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Feisbuk" value="<?php echo $empresa['nombre']; ?>" required>
          </div>
          <div class="form-group">
          <label>CIF <i class="fa fa-lock"></i></label>
          <input type="text" id="cif" name="cif" class="form-control" placeholder="B12345678" value="<?php echo $empresa['CIF']; ?>" required>
          </div>
          <div class="form-group">
          <label>Dirección</label>
          <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Calle Falsa, 2" value="<?php echo $empresa['direccion']; ?>" required>
          </div>
          <div class="form-group">
          <label>Teléfono</label>
          <input type="text" id="telefono" name="telefono" class="form-control" placeholder="612345678" value="<?php echo $empresa['telefono']; ?>" required>
          </div>
        </div>
        <div class="col-md-6 col-lg-6">
          <div class="form-group">
          <label>Fax</label>
          <input type="text" id="fax" name="fax" class="form-control" placeholder="612345678" value="<?php echo $empresa['fax']; ?>">
          </div>
          <div class="form-group">
          <label>Imagen</label>
          <input type="file" class="form-control" id="imagen" name="imagen">
          </div>
          <div class="form-group">
          <label>Descripción</label>
          <textarea rows="7" id="descripcion" name="descripcion" class="form-control" placeholder="Pequeña descripción de la empresa..." required><?php echo $empresa['descripcion']; ?></textarea>
          </div>
        </div>
        </div>
        <input type="submit" class="btn btn-default btnCrearSala" value="Editar">
      </form>
      <?php
      }
      ?>

</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("empresas").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>
