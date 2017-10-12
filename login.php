<?php
	session_start();
	if(isset($_GET['check'])){
		if(!isset($_POST['user']) || !isset($_POST['pwd']))
			echo "<script>alert(\"输入非法\")</script>";
		else{
			$user = addslashes($_POST['user']);
			$pwd = addslashes($_POST['pwd']);
			include_once("sqlcon.php");
			$sql = "SELECT * FROM users WHERE user='{$user}' and pwd='{$pwd}';";
			// echo $sql;
			$res = mysql_query($sql);
	        // $num = mysql_num_rows($res);
	        $flag = mysql_fetch_array($res, MYSQL_ASSOC);
	        // var_dump($flag);
			// var_dump($res);
			mysql_free_result($res);
			mysql_close($conn);
			// echo $user;
			if(!$flag)
				echo "<script>alert(\"账号密码错误\")</script>";
			else{
				$_SESSION['user'] = $user;
				// echo $_SESSION['user'];
				header("Location: home.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<!-- <link rel="stylesheet" type="text/css" href="css/main.css"/> -->
		<style>
			.login{
				width:300px;
				margin:30px auto;
			}
		</style>
	</head>
	<body background="css/imgs/2.jpg">
		<a href="home.php">返回首页</a>
		<div class="login">
			<form action="login.php?check=get" method="post">
				<p>账号：</p>
				<input type="text" name="user"/>
				<p>密码：</p>
				<input type="text" name="pwd"/>
				<br>
				<a href="reg.php">注册</a>
				<input type="submit" value="登录"/>
			</form>
		</div>
	</body>
</html>