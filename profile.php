<?php 
session_start();

$nav_profile = array('short_info'=>'Краткая информация',
					 'full_info' => 'Посмотреть полную информацию',
					 'trips' => 'Мои поездки',
					 'change' => 'Изменить данные'
);

require_once('functions.php');

if($_POST['full_info'])
{
	$page_content = renderTemplate('views/profile_full_info.php',['error_list' => $error_list,'nav_profile'=>$nav_profile]);
}
elseif($_POST['trips'])
{
	$rows_of_trips = [];
	include("config/db.php");
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	$res = $mysqli->query("SELECT `trips`.`datetime_start` , `trips`.`datetime_end`, `trips`.`route`, `trips`.`coast` , `cars`.`brand`, `cars`.`model`, `cars`.`reg_number`, `cars`.`photo` FROM `trips` INNER JOIN `cars` ON `trips`.`id_cars`=`cars`.`id` WHERE `trips`.`id_users` = '".$_SESSION['uid']."'");
	while($row = $res->fetch_assoc())
	{
		array_push($rows_of_trips, $row);
	}
	$mysqli->close();
	
	$page_content = renderTemplate('views/profile_trips.php',['error_list' => $error_list,'nav_profile'=>$nav_profile,'rows_of_trips'=>$rows_of_trips]);
	
}
elseif($_POST['change'])
{
	$page_content = renderTemplate('views/profile_change.php',['error_list' => $error_list,'nav_profile'=>$nav_profile]);
}
else
{
	$page_content = renderTemplate('views/profile_short_info.php',['error_list' => $error_list,'nav_profile'=>$nav_profile,'display_window'=>$_SESSION['new_acc']]);
}

$title = "Личный кабинет";
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
print($layout_content);

?>