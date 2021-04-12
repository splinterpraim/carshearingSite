<?php 
require_once('function/functions.php');
include("config/db.php");


$title = 'Машины';



$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);

	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	$res = $mysqli->query("SELECT DISTINCT CONCAT(`cars`.`brand`,' ', `cars`.`model`) as ncar ,`cars`.`photo`, `cars`.`id_levels`, `levels`.`name`
							FROM `cars` 
							INNER JOIN `levels` ON `levels`.`id` = `cars`.`id_levels`
							ORDER BY  `cars`.`id_levels`");
	$one_kind_of_car = array();
	$all_car = array();
	$one = $res->fetch_assoc();
	$kind = ['id'=>$one['id_levels'],'name'=>$one['name']];

	while($one = $res->fetch_assoc())
	{
		if($kind['id']!=$one['id_levels'])
		{
			$all_car[$kind['name']] = $one_kind_of_car;
			$one_kind_of_car = array();
			$kind['id'] = $one['id_levels'];
			$kind['name'] = $one['name'];
		}
		array_push($one_kind_of_car, $one);
	}
	$all_car[$kind['name']] = $one_kind_of_car;
			
	$mysqli->close();

	$page_content = renderTemplate('views/cars.php',['all_car' => $all_car]);

$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);


 ?>
 




