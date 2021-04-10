<?php
require_once('function/functions.php');
include("config/db.php");

$cities = array();

//Если есть сообщение
if($_POST['msg'])
{
	mail('support@futucar.com', $_POST['umail'], $_POST['msg']);
}

$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
if($mysqli->connect_errno){
	echo "Ошибка подключения к бд".$mysqli->connect_errno;
	exit();
}
//Выборка данных о всех городах
$res = $mysqli->query("SELECT `id`,`name`,`area`,`office`,`phone` FROM `cities`");
while($one = $res->fetch_assoc())
{
	array_push($cities, $one);
}
$mysqli->close();

$title = "Контакты";
$page_content = renderTemplate('views/contacts.php',['error_list' => $error_list,'cities'=>$cities]); 
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
print($layout_content);
?>