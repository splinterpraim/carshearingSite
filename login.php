<?php
$error_list = array();
$p="n";
/*var_dump($_POST);
exit();*/
if($_POST["autorization"] == "Вход")
{
	$p="y";
	include("db.php");
	$p="y";
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
			array_push($error_list, "Неверный пароль");
		}
	}
	else
	{	
		array_push($error_list, "Неверный логин");
	}
	

	unset($basaDB);

}

require_once('functions.php');
$title = "Вход";


$page_content = renderTemplate('views/login.php',['error_list' => $error_list,'p'=>$p]); 
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
var_dump($layout_content);flush();
?>