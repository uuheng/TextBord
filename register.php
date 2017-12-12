<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="css/public.css" />
		<link rel="stylesheet" href="css/register.css"/>
	</head>
	<body>
		<a href="index.php">返回首页</a>
		<div class="reg_box">
			<form action="register.php?reg=1" method="post">
				<p>注册账号：</p>
				<input type="text" name="user"/>
				<p>注册密码：</p>
				<input type="password" name="pwd"/>
				<p>确认密码：</p>
				<input type="password" name="pwd_r"/>
				<input type="submit" value="注册"/>
			</form>
		</div>
	</body>
</html>
<?php
if(empty($_GET['reg']))
	exit;
if(!isset($_POST['user']) || !isset($_POST['pwd']) || !isset($_POST['pwd_r'])){
	echo "<script>alert('信息不完整')</script>";
	exit;
}
	//过滤特殊字符
$user = addslashes($_POST['user']);
$pwd = addslashes($_POST['pwd']);
$pwd_r = addslashes($_POST['pwd_r']);

include_once("sqlcon.php");
$sql = "SELECT user FROM users WHERE user='{$user}';";
$res = mysqli_query($conn, $sql);
$flag = mysqli_fetch_assoc($res);
// var_dump($flag);
if($flag){
	echo "<script>alert(\"该用户已存在\")</script>";
	mysqli_free_result($res);
	mysqli_close($conn);
	exit;
}
//会了js以后在前端验证
if($pwd!=$pwd_r){
	echo "<script>alert(\"两次密码输入不一致\")</script>";
	mysqli_close($conn);
	exit;
	// header("Location: reg.php");
}
else{
	$sql = "INSERT INTO users (user, pwd) values ('{$user}', '{$pwd}');";
	$res = mysqli_query($conn, $sql);
	// var_dump($res);
	if(!$res)
		die("注册失败：".mysql_error());
	else
		echo "<script>alert('注册成功')</script>";
}
mysqli_close($conn);
?>
