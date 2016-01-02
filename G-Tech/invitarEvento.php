<?php include 'header.php';
if(!isset($_SESSION['login'])){
	echo '<script>location.href="inicioSesion.php";</script>';
}
$idEvento = $_GET['i'];
?>
<section>
		<h1 class="section-header">Invitar
		<hr></hr></h1>
		<article>
      <form id="formularioInvitarEvento" method="POST" action="javascript:InvitarEvento()" data-toggle="validator" role="form">
				<input type="hidden" name="id" id="id" value="<?php echo $idEvento; ?>">
        <div class="form-group">
        <label>Email</label>
        <input type="text" id="emails" name="emails" class="form-control" placeholder="ejemplo@ejemplo.com,ejemplo2@ejemplo.com" required>
        <span id="helpBlock" class="help-block">
          * Puede invitar a tantas personas como desee, escriba los emails separados por comas
        </span>
        </div>
				<button type="button" class="btn btn-primary btnVolver" onclick="window.history.back();return false;">Volver</button>
      <input type="submit" class="btn btn-default btnCrearSala" value="Invitar">
    </form>
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("eventos").className = "active menu";
		$('table').stacktable();
}
</script>
<?php include 'footer.php'; ?>
