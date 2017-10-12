<?php
	session_start();
	unset($_SESSION['user']);
	// echo $_SESSON['user'];
	header("Location: home.php");
?>