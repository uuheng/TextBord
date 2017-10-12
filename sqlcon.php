<?php
	
	$conn = mysql_connect("localhost", "root", "qyffxzh152505");
	if(!$conn)
		die("连接数据库错误：".mysql_error());
	mysql_select_db("uheng");
	mysql_query("set names 'utf8'");  
?>