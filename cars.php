<?php 
require_once('function/functions.php');
include("config/db.php");

$rows_of_car = array();
$rows_of_city = array();
$sort_car = 'ASC';
$filter_of_sort = $_POST["filter"];
$selected_city = $_POST["cities"];
$title = 'Аренда';
//echo isset($_POST['stop']);exit();
if($_POST['stop'])
{
	unset($_SESSION['drive']);

	$page_content = renderTemplate('views/rent_end.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}
elseif($_POST['start'] or $_SESSION['drive'] )
{
	$_SESSION['drive'] ='true';
	$page_content = renderTemplate('views/rent.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}

elseif($_POST['choise_car'])
{
	$page_content = renderTemplate('views/rent.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}
else
{

	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
	if($mysqli->connect_errno){
			echo "Ошибка подключения к бд".$mysqli->connect_errno;
			exit();
		}

	if($_POST["filter"]=="По убыванию цены")
	{
		$sort_car = 'DESC';
	}
	$res='';
	if(!isset($_POST["cities"]) || ($_POST["cities"]=="Все"))
	{
		$res = $mysqli->query("	SELECT `cars`.`id`,`cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
								FROM `cars` 
								INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
								INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id`
	                            ORDER BY `cars`.`price_to_min`".$sort_car.";");
	}
	else
	{ 
		$res = $mysqli->query("	SELECT `cars`.`id`,`cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
								FROM `cars` 
								INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
								INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id`
								HAVING `cities`.`name`=\"".$_POST["cities"]."\"
	                            ORDER BY `cars`.`price_to_min`".$sort_car.";");
	}

	while($row = $res->fetch_assoc())
	{
		array_push($rows_of_car, $row);
	}

	$res = $mysqli->query("SELECT DISTINCT `name` FROM `cities`;");
	while($row = $res->fetch_assoc())
	{
		array_push($rows_of_city, $row);
	}
	$mysqli->close();



	$page_content = renderTemplate('views/cars.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);


 ?>
 




