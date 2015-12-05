<?php
session_start();
$_SESSION = array();
session_destroy();
?>
<script languaje="javascript">
location.href = "../index.php";
</script>
