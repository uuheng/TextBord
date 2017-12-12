<?php
	session_start();
	// var_dump($_SESSION['user']);
	include_once("sqlcon.php");
	$sql = "SELECT * FROM msg ORDER BY up_time DESC";
	$res = mysqli_query($conn, $sql);
	// var_dump($res);
	$rows = array();
	while($row = mysqli_fetch_assoc($res))
		$rows[] = $row;
	// var_dump($rows);
	mysqli_free_result($res);
	mysqli_close($conn);
	// var_dump($rows);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/public.css" />
	</head>
	<body>
	<body>
		<!-- <img src="back1.jpg"/> -->
		<header>
			asdfsdf
		</header>
		<div class="content">
		<div class="add-box">
			<?php if(!isset($_SESSION['user'])) { ?>
			<a href="login.php">登录</a>
			<?php }else{ ?>
			当前用户：<?php echo $_SESSION['user'] ?>  <a href="logout.php">退出</a>
			<?php } ?>
			<form action="insert.php" method="post">
				<textarea name="text"></textarea>
				<!-- <span>输入作者姓名：</span>
				<input class="user" type="text" name="user"/> -->
				<?php if(isset($_SESSION['user'])) {?>
					<input type="hidden" name="user" value="<?php echo $_SESSION['user'] ?>"/>
					<input class="bnt" type="submit" value="发表"/>
				<?php } ?>
			</form>
		</div>
		<div class="msg-box">
			<?php
				foreach($rows as $item){
			?>
			<div class="item">
				<span><?php echo $item['author'] ?></span>
				<span class="date"><?php if($_SESSION['user'] == "admin" || $item['author'] == $_SESSION['user']){ ?>
					<a href='del.php?id=<?php echo $item['id'] ?>'>删除</a>
				<?php } ?></span>
				<span class="date"><?php echo $item['up_time'] ?></span>
				<p><?php echo $item['text'] ?></p>
			</div>
			<?php
				}
			?>
		</div>
		</div>
	</body>
</html>
