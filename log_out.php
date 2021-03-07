<?php




?>

<!DOCTYPE html>
<html>
<head>
	<title>logout</title>
</head>
<body bgcolor="#F0E68C">
	<form action="index.php" method="post">
		<table align="center">
		<tr>
			<td>Логин:</td>
			<td><input type="text" name="login"></td>
		</tr><br>
		<tr>
			<td>Пароль:</td>
			<td><input type="text" name="password"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="autorization" value="Вход"></td>
		</tr>
		</table>
		 <br>
		
	</form>
	<div align="center"><form action="creat_new_account.php" method="post"><input type="submit" name="regs" value="Зарегестрироваться"></form></div>
</body>
</html>