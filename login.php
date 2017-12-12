<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8" />
		<!-- <link rel="stylesheet" type="text/css" href="css/main.css"/> -->
		<link rel="stylesheet" type="text/css" href="css/public.css" />
		<link rel="stylesheet" href="css/login.css" />
	</head>
	<body>
		<a href="index.php">返回首页</a>
		<div class="login">
			<form action="login.php?check=get" method="post">
				<p>账号：</p>
				<input type="text" name="user"/>
				<p>密码：</p>
				<input type="password" name="pwd"/>
				<br>
				<a href="register.php">注册</a>
				<input type="submit" value="登录"/>
			</form>
		</div>
	</body>
</html>

<?php
session_start();
if(!isset($_POST['user']) || !isset($_POST['pwd']))
	exit;
$user = addslashes($_POST['user']);
$pwd = addslashes($_POST['pwd']);
include_once("sqlcon.php");
$sql = "SELECT * FROM users WHERE user='{$user}' and pwd='{$pwd}';";
// echo $sql;
$res = mysqli_query($conn, $sql);
// $num = mysql_num_rows($res);
$flag = mysqli_fetch_assoc($res);
// var_dump($flag);
// var_dump($res);
mysqli_free_result($res);
mysqli_close($conn);
// echo $user;
if(!$flag)
	echo "<script>alert(\"账号或密码错误\")</script>";
else{
	$_SESSION['user'] = $user;
	// echo $_SESSION['user'];
	header("Location: index.php");
}
?>
