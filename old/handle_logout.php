<?php
if($_POST["autorization"] == "Вход")
{
	//include("db.php");

	$basaDB = new DB();
	$basaDB->get_request("SELECT `id_user` AS uid,`password` FROM `authorization` WHERE `login`=\"".$_POST["login"]."\";");
	$sql_answer = $basaDB->unpacking();
	if(isset($sql_answer))
	{
		if($_POST["password"] == $sql_answer['password'])
		{	
			
			$_SESSION['uid'] = $sql_answer['uid'];
		}
		else
		{
			echo "Неверный пароль";
		}
	}
	else
	{
		echo "Неверный логин";
	}
	

	unset($basaDB);

}
?>