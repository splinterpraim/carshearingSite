<?php
session_start();
require_once('function/functions.php');
include("config/db.php");

$messages = array();
$msg_colors =array('#2ebcdb','yellow','#2edb54','#e5bf32');


$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}

if(isset($_POST['msg']))
{
	
	$who = 'Аноним';
	if($_SESSION['name'])
	{
		$who = $_SESSION['name'];
	}

	$mysqli->query("INSERT INTO  `guest_page` (`who`,`msg`) VALUES ('".$who."','".$_POST['msg_text']."')");

}



//Выборка данных о всех городах
$res = $mysqli->query("SELECT `id`,`who`,`msg`,`data_msg` FROM `guest_page` ORDER BY `data_msg` DESC");
while($one = $res->fetch_assoc())
{
	array_push($messages, $one);
}
$mysqli->close();


$title = "Гостевая книга";
 
$page_content = renderTemplate('views/guest_page.php',['name' => 'Олег','messages'=>$messages,'msg_colors'=>$msg_colors]);
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);
?>