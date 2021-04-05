<?php 

include("config/db.php");

$rows_of_car = array();
$rows_of_city = array();
$sort_car = 'ASC';
$filter_of_sort = $_POST["filter"];
$selected_city = $_POST["cities"];
$basaDB = new DB();

if($_POST["filter"]=="По убыванию цены")
{
	$sort_car = 'DESC';
}

if(!isset($_POST["cities"]) || ($_POST["cities"]=="Все"))
{
	$basaDB->get_request("	SELECT `cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
							FROM `cars` 
							INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
							INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id`
                            ORDER BY `cars`.`price_to_min`".$sort_car.";");
}
else
{ 
	$basaDB->get_request("	SELECT `cars`.`brand`, `cars`.`model`, `cars`.`reg_number`,`cars`.`photo`, `cars`.`petrol_count`, `cars`.`location`, `cars`.`price_to_min`, `cars`.`status`, `cities`.`name` AS city,`levels`.`name` AS levels
							FROM `cars` 
							INNER JOIN `cities` ON `cars`.`id_cities`=`cities`.`id`
							INNER JOIN `levels` ON `cars`.`id_levels`=`levels`.`id`
							HAVING `cities`.`name`=\"".$_POST["cities"]."\"
                            ORDER BY `cars`.`price_to_min`".$sort_car.";");
}

while($row = $basaDB->unpacking())
{
	array_push($rows_of_car, $row);
}

$basaDB->get_request("SELECT DISTINCT `name` FROM `cities`;");
while($row = $basaDB->unpacking())
{
	array_push($rows_of_city, $row);
}
unset($basaDB);
require_once('functions.php');

/*print_r($rows_of_car);
echo "gh";
exit();*/

$title = 'Машины';
$page_content = renderTemplate('views/cars.php',['rows_of_city' => $rows_of_city, 'selected_city' => $selected_city, 'filter_of_sort' => $filter_of_sort, 'rows_of_car' => $rows_of_car]);
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);


 ?>
 




