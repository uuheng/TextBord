<?php

	$conn = mysqli_connect("localhost", "root", "qyffxzh152505", "uheng");
	if(!$conn)
		die("连接数据库错误：".mysqli_error());
	mysqli_query($conn, "set names 'utf8'");
?>
