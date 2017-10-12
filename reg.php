<DOCTYPE html>
<html>
	<head>
		<meta charset="utf8"/>
		<style>
			.reg{
				width:300px;
				margin:30px auto;
			}
		</style>
	</head>
	<body background="css/imgs/2.jpg">
		<a href="home.php">返回首页</a>
		<div class="reg">
			<form action="reg.php?flag=1" method="post">
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
	if(isset($_GET['flag'])){
		if(isset($_POST['user']) && isset($_POST['pwd']) && isset($_POST['pwd_r'])){
			$user = addslashes($_POST['user']);
			include_once("sqlcon.php");
			$sql = "SELECT * FROM users WHERE user='{$user}';";
			$res = mysql_query($sql, $conn);
			$flag = mysql_fetch_array($res, MYSQL_ASSOC);
			if($flag){
				echo "<script>alert(\"该用户已存在\")</script>";
				exit;
			}
			$pwd = addslashes($_POST['pwd']);
			$pwd_r = addslashes($_POST['pwd_r']);
			if($pwd!=$pwd_r){
				echo "<script>alert(\"两次密码输入不一致\")</script>";
				// header("Location: reg.php");
			}
			else{
				include_once("sqlcon.php");
				$sql = "INSERT INTO users (user, pwd) values ('{$user}', '{$pwd}');";
				$res = mysql_query($sql, $conn);
				if(!$res)
					die("注册失败：".mysql_error());
				header("Location: login.php");
			}
		}
		else{
			echo "<script>alert(\"填写信息不完整\")</script>";
			header("Location: reg.php");
		}
		mysql_free_result($res);
		mysql_close($conn);
	}
?>