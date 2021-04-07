<?php
session_start();
$error_list = array();
$p="n";
$redirect = false;

if($_POST["autorization"] == "Вход")
{
	include("config/db.php");
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	$res = $mysqli->query("SELECT `id_user` AS uid,`password` FROM `authorization` WHERE `login`=\"".$_POST["login"]."\";");


	$sql_answer = $res->fetch_assoc();
	
	if(isset($sql_answer))
	{
		if($_POST["password"] == $sql_answer['password'])
		{	
			
			$_SESSION['uid'] = $sql_answer['uid'];
		}
		else
		{
			array_push($error_list, "Неверный пароль");
		}
	}
	else
	{	
		array_push($error_list, "Неверный логин");
	}
	$mysqli->close();
	if (count($error_list)<1){
		$redirect = true;
	}


}

require_once('functions.php');
if($redirect)
{
	//поставить сессию
	header("Location: http://futucar/profile.php");
}
else
{


	$title = "Авторизация";



	$page_content = renderTemplate('views/login.php',['error_list' => $error_list]); 
	$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
	print($layout_content);

}
?>