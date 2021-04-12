<?php 
session_start();
require_once('function/functions.php');
include("config/db.php");
 

$title = 'Аренда';

//Если поездка закончена
if($_POST['stop'])
{

	unset($_SESSION['drive']);
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);

	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	
	//Выборка данных о поездке
	$res = $mysqli->query("SELECT `trips`.`datetime_start`, `trips`.`id_cars` FROM `trips` WHERE `trips`.`id_users` = ".$_SESSION['uid']."  ORDER BY `trips`.`datetime_start` DESC LIMIT 1");
	$trip = $res->fetch_assoc();
	//Выборка количества поездок пользователя
	$res = $mysqli->query("SELECT COUNT(*) AS count FROM `trips` WHERE `trips`.`id_users` = ".$_SESSION['uid']);
	$All_trips = $res->fetch_assoc();
	//Выборка данных о машине
	$res = $mysqli->query("	SELECT `cars`.`id`, `cars`.`petrol_count`,  `cars`.`price_to_min`
							FROM `cars` 
							WHERE `cars`.`id` = ".$trip['id_cars']);
	$onecar = $res->fetch_assoc();
	//Выборка данных о тарифе пользователя и баллах
	$res = $mysqli->query("SELECT `tariffs`.`delta_price`,`users`.`points`,`users`.`id_levels` FROM `users` INNER JOIN `tariffs` ON `users`.`id_tariffs` = `tariffs`.`id` WHERE `users`.`id` =".$_SESSION['uid']);
	$tariff = $res->fetch_assoc();
	//Выборка данных о всех уровнях
	$res = $mysqli->query("SELECT `id`,`points`,`trips` FROM `levels`");
	$now_level = 1;
	//Определение текущего уровня
	while ($key=$res->fetch_assoc()) {
		if(((int)$tariff['points']>=(int)$key['points']) AND ((int)$All_trips['count']>=(int)$key['trips']))
		{
				$now_level = (int)$key['id'];
		}
	}
	$str_level = "";
	if($now_level!=$tariff['id_levels'])
	{
			$str_level = ",`users`.`id_levels` = ".$now_level;
	}


	//Время текущей поездки в минутах
	$time = (time() - strtotime ($trip['datetime_start']))/60;
	//Цена текущей поездки 
	$coast = round((1+$tariff['delta_price']/100) * $onecar['price_to_min'] * $time,2);
	//Количество бензина машины
	$new_petrol = round($onecar['petrol_count'] - $time/2);
	//Количество баллов + новые баллы
	$new_points = $tariff['points'] + round($time)/10;

	//Обновление стоимости и конца поездки 
	$res = $mysqli->query("UPDATE `trips` SET `trips`.`coast` = ".round($coast).", `trips`.`datetime_end` = '".date("Y-m-d H:i:s")."' 
						WHERE `trips`.`id_users` = ".$_SESSION['uid']." AND `trips`.`id_cars` = ".$trip['id_cars']." AND `trips`.`datetime_start` = '".$trip['datetime_start']."'");
	//Обновление статуса машины и бензина
	$res = $mysqli->query("UPDATE `cars` SET `cars`.`status` = 'свободна', `cars`.`petrol_count` = ".$new_petrol."  WHERE `cars`.`id` =  ".$trip['id_cars']);
	//Обновление  баллов и уровня пользователя 
	$res = $mysqli->query("UPDATE `users` SET `users`.`points` = ".$new_points." ".$str_level." WHERE `users`.`id` =  ".$_SESSION['uid']);
	

	$mysqli->close();

	$page_content = renderTemplate('views/rent_end.php',['time'=>round($time,2),'coast'=>$coast]);
}
//Если поездка началась или уже идет
elseif($_POST['start'] or $_SESSION['drive']=='true' ) 
{

	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);

	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	//записать данные в БД если start
	if(($_POST['start']) and ($_SESSION['drive']!='true'))
	{
			
			//Выборка местоположения машины
			$res = $mysqli->query("SELECT `cars`.`location` FROM `cars` WHERE `cars`.`id` = ".$_POST['id_car']);
			$loc = $res->fetch_assoc();
			//Составление маршрута
			$route = $loc['location'].":".$_POST['to'];
			//Обновление местоположения машины
			$res = $mysqli->query("UPDATE `cars` SET `cars`.`location`= '".$_POST['to']."', `cars`.`status` = 'занята' WHERE `cars`.`id` =  ".$_POST['id_car']);
			//Создание новой записи о поездке
			$res = $mysqli->query("INSERT INTO `trips` (`trips`.`id_users`,`trips`.`id_cars`,`trips`.`route`)
									VALUES(".$_SESSION['uid'].",".$_POST['id_car'].",'".$route."')");


	}
	//взять из бд данные
	//умножить разделить и вывести сумму
	//Выборка даты и машины текущей поездки
	$res = $mysqli->query("SELECT `trips`.`datetime_start`, `trips`.`id_cars`,`trips`.`route` FROM `trips` WHERE `trips`.`id_users` = ".$_SESSION['uid']."  ORDER BY `trips`.`datetime_start` DESC LIMIT 1");
	$trip = $res->fetch_assoc();
	//Выборка данных о машине
	$res = $mysqli->query("	SELECT `cars`.`id`,`cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
										FROM `cars` 
										INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
										INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id` 
										WHERE `cars`.`id` = ".$trip['id_cars']);
	$onecar = $res->fetch_assoc();
	//Выборка данных о тарифе пользователя
	$res = $mysqli->query("SELECT `tariffs`.`delta_price` FROM `users` INNER JOIN `tariffs` ON `users`.`id_tariffs` = `tariffs`.`id` WHERE `users`.`id` =".$_SESSION['uid']);
	$tariff = $res->fetch_assoc();
	$mysqli->close();

	//Время текущей поездки в минутах
	$time = (time() - strtotime ($trip['datetime_start']))/60;
	//Цена текущей поездки 
	$coast = round((1+$tariff['delta_price']/100) * $onecar['price_to_min'] * $time,2);
	$new_petrol = round($onecar['petrol_count'] - $time/2);
	

	$new_value_route = preg_split("/(:)/", $trip['route']);
	$_SESSION['drive'] ='true';
	$page_content = renderTemplate('views/rent.php',['onecar' => $onecar,'time'=>round($time,2),'coast'=>$coast,'new_value_route'=>$new_value_route,'new_petrol'=>$new_petrol]);
}
//Если пользователь выбрал машину
elseif($_POST['choise_car'])
{
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);

	if($mysqli->connect_errno){
			echo "Ошибка подключения к бд".$mysqli->connect_errno;
			exit();
	}
	//Выборка данных о машине
	$res = $mysqli->query("	SELECT `cars`.`id`,`cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
								FROM `cars` 
								INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
								INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id` 
								WHERE `cars`.`id` = ".$_POST['id_car']);
	$onecar = $res->fetch_assoc();
	$mysqli->close();


	$page_content = renderTemplate('views/rent.php',['onecar' => $onecar]);
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
								WHERE `cars`.`status` = 'свободна'
	                            ORDER BY `cars`.`price_to_min`".$sort_car.";");
	}
	//Иначе сделать установленный фильтр по городам
	else
	{ 
		$res = $mysqli->query("	SELECT `cars`.`id`,`cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
								FROM `cars` 
								INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
								INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id`
								WHERE `cities`.`name`= '".$_POST["cities"]."' AND `cars`.`status` = 'свободна'
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

	$page_content = renderTemplate('views/rent_cars.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
}
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);


 ?>
 




