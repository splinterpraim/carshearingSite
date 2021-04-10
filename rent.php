<?php 
session_start();
require_once('function/functions.php');
include("config/db.php");


$title = 'Аренда';

//Если поездка закончена
if($_POST['stop'])
{
	unset($_SESSION['drive']);
	//записать результирующую сумму в бд и время конца
	$page_content = renderTemplate('views/rent_end.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}
//Если поездка началась или уже идет
elseif($_POST['start'] or $_SESSION['drive']=='true' )
{
	$_SESSION['drive'] ='true';
	//записать данные в БД если start
	//взять из бд данные
	//умножить разделить и вывести сумму
	$page_content = renderTemplate('views/rent.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}
//Если пользователь выбрал машину
elseif($_POST['choise_car'])
{
	$_POST['id_car'];
	//****************************************************///*****************************
	//отобразить выбранную машину
	//сделать hidden поле для id car
	$page_content = renderTemplate('views/rent.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}
//Иначе первый раз зашел на аренду
else
{
	//Переменные для отображение машин
	$rows_of_car = array();
	$rows_of_city = array();
	$sort_car = 'ASC';
	$filter_of_sort = $_POST["filter"];
	$selected_city = $_POST["cities"];
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);

	if($mysqli->connect_errno){
			echo "Ошибка подключения к бд".$mysqli->connect_errno;
			exit();
	}
	//Если выбран Фильтр 'По убыванию цены'
	if($_POST["filter"]=="По убыванию цены")
		$sort_car = 'DESC';
	
	$res='';
	//Если выбраны все города или пользователь только зашел на страницу
	if(!isset($_POST["cities"]) || ($_POST["cities"]=="Все"))
	{
		$res = $mysqli->query("	SELECT `cars`.`id`,`cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
								FROM `cars` 
								INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
								INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id`
	                            ORDER BY `cars`.`price_to_min`".$sort_car.";");
	}
	//Иначе сделать установленный фильтр по городам
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
	//Выборка названия всех городов
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
 




