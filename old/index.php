<?php
session_start();
include("db.php");
if($_POST['exit'] == 'Выход')
{
	$_SESSION = array();
	session_destroy();
}

include("handle_logout.php");

if (!isset($_SESSION['uid'])) //если id пользователя нет то предоставить ему поле авторизации
{
	include("log_out.php");
}
else // если id есть то загрузить главную страницу
{
	
//include("db.php");
//unset($basaDB);
$basaDB = new DB();
$basaDB->get_request("SELECT `users`.`name` FROM `users` WHERE `users`.`id` = '".$_SESSION['uid']."'");

$user_name = $basaDB->unpacking();

unset($basaDB);

//mysqli_num_rows($result); // количество записей которое вернул SELCT

/*
•	Запрос на выборку информации, отсортированной по возрастанию или убыванию цены (даты или что-то иного); // cars.price_to_min
•	Запрос на выборку с критерием отбора; cars.id_cities
•	Запрос на обновление данных; //users.name
•	Запрос на добавление данных; new user
•	Многотабличный запрос.  //user trips cars

*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Lab3
	</title>
	<style type="">
		.menu {
			  width: 15em;
			  border: 1px solid #333;
			  box-shadow: 8px 8px 5px #444;
			  padding: 8px 12px;
			  background-image: linear-gradient(180deg, #fff, #ddd 40%, #ccc);
			}
	</style>
</head>
<body bgcolor="#D8BFD8">

	<div align="Right">
		<form action="index.php" method="post"><input type="submit" name="exit" value="Выход"></form>
	</div>
	<div style="font-size: 30px; padding-left: 30px; color: #32CD32;">
		<b><?php echo "Привет, ".$user_name['name'];?></b>
	</div>
	<br>
	<div>
	<div class="menu">
		<a href="show_car.php">Посмотреть машины</a>
	</div>
	<div class="menu">
		<a href="change_name.php">Изменить свое имя</a>
	</div>
	<div class="menu">
		<a href="show_trips.php">Посмотреть поездки</a>
	

</body>
</html>

<?php  }?>