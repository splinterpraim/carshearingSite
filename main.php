<?php
require_once('function/functions.php');
include("config/db.php");


if($_POST['tarifs'])
{
	$tariffs = array();
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);

	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	$res = $mysqli->query("SELECT `tariffs`.`id`, `tariffs`.`name`, `tariffs`.`delta_price`, `tariffs`.`discription` FROM `tariffs`");
	while($one = $res->fetch_assoc())
	{
		array_push($tariffs, $one);
	}
	$mysqli->close();
	$title = "Тарифы";
	 
	$page_content = renderTemplate('views/main.php',['name' => 'Олег','tariffs'=>$tariffs]);
	$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
	print($layout_content);
}
elseif($_POST['levels'])
{
	

	$levels = array();
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);

	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	$res = $mysqli->query("SELECT `levels`.`id`,`levels`.`name`,`levels`.`points`,`levels`.`trips`,`levels`.`discription` FROM `levels`");
	while($one = $res->fetch_assoc())
	{
		array_push($levels, $one);
	}
	$mysqli->close();
	$title = "Уровни";
	 
	$page_content = renderTemplate('views/main.php',['name' => 'Олег','levels'=>$levels]);
	$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
	print($layout_content);
}
else
{
	$title = "Главная";
	 
	$page_content = renderTemplate('views/main.php',['name' => 'Олег']);
	$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
	print($layout_content);
}

?>