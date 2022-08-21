<?php
	unset($_SESSION['username']);
	unset($_SESSION['hak_akses']);
	session_destroy();
	echo "<script>location='./'</script>";
	die();
?>