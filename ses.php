<?php
	session_start();

	$_SESSION['name'] = $_POST['input'];
	echo $_SESSION['name'];

?>
<form action="" method="post">
	<input type="text" name="input"/>
	<input type="submit" value="go"/>
</form>