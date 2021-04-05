<?php
if(isset($_POST['name']))
{		session_start();
		include("db.php");
		$basaDB = new DB();
		$basaDB->get_request("UPDATE `users` SET  `users`.`name` = '".$_POST['name']."' WHERE `users`.`id` = ".$_SESSION['uid'].";");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lab3 change name</title>
</head>
<body bgcolor="#D8BFD8">
	<div style="float: right;">
	<form action="index.php">
		<input type="submit" name="main" value="На Главную">
	</form>
	</div> 
	<div>
		<form action="change_name.php" method="post">
			Введите новое имя: 
			<input type="text" name="name" <?php echo "value=\"".$_POST['name']."\""?>>
			<input type="submit" name="butt" value="Изменить">
		</form>
	</div>
	<div align="center" style="font-size: 20pt; color: #FF4500;">
		<b>
	<?php 
	if(isset($_POST['name']))
	echo "Имя изменено на  ".$_POST['name']."!";?>
		</b>
	</div>
	
</body>
</html>