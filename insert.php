<?php
	include_once("sqlcon.php");
	date_default_timezone_set('Asia/Shanghai'); 

	if(!isset($_POST['text']) || !isset($_POST['user'])){
		echo "<script>alert(\"内容不能为空！\")</script>";
		// exit;
	}

	$author = addslashes($_POST['user']);
	$text = addslashes($_POST['text']);
	// var_dump(stripos($text,"<script>"));
	if(stripos($text,"<") !== false){
		echo "<script>alert(\"发表失败\")</script>";
		header("Location: home.php");
		exit;
	}
	$t = date("Y-m-d H:i:s", time());
	$sql = "INSERT INTO msg (author, text, up_time) values ('{$author}', '{$text}', '{$t}');";
	// echo $sql;
	$flag = mysql_query($sql, $conn);
	if(!flag)
		die("插入失败:".mysql_error());
	else{
		header("Location: home.php");
	}
	mysql_free_result($res);
	mysql_close($conn);
?>