<?php
	session_start();
	if(!isset($_SESSION['user'])){
		// echo "<script>alert(\"你没有管理员权限\")</script>";
		header("Location: home.php");
		exit;
	}
	// var_dump($_SESSION);
	include_once("sqlcon.php");
	if(!isset($_GET['id'])){
		header("Location: home.php");
		exit;
	}
	$sql = "DELETE FROM msg WHERE id={$_GET['id']};";
	$flag = mysql_query($sql, $conn);
	if(!flag)
		die("删除失败：".mysql_error());
	mysql_close($conn);
	header("Location: home.php");
?>

