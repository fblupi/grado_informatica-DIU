<?php include 'header.php'; ?>
<section>
<h1 class="section-header">Mi cuenta<hr></hr></h1>
<article>
<?php 
include 'dbConnect.php';
$conn = dbConnect();
$login = $_SESSION['login'];
	
$sql = "SELECT * FROM Usuario WHERE login = '$login'";

$resultado = mysqli_query($conn, $sql);

while($usuario = mysqli_fetch_assoc($resultado)){
	echo '<img src="';
	echo $usuario['imagen'];
	echo '">';
}

?>	
</article>
</section>
<script type="text/javascript">
window.onload = function()
{
		document.getElementById("micuenta").className = "active menu";
}
</script>
<?php include 'footer.php'; ?>