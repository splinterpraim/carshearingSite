<?php 
session_start();

include("config/db.php");
require_once('function/functions.php');

//Переменные
$info_drive = '';
$good = 'good';
$bad = 'bad';
$check = ['pasport'=>'','autopassport'=>'','credit_cart'=>'','phone'=>'']; 
$bad_field = array();
$nav_profile = array('short_info'=>'Краткая информация',
					 'full_info' => 'Посмотреть полную информацию',
					 'trips' => 'Мои поездки',
					 'change' => 'Изменить данные'
);

if($_SESSION['drive'])
	$info_drive = 'У вас есть незаконченная поездка';
//Нажата кнопка изменений
if($_POST['form'] == 'make_change')
{
	$changes_list = array();	
	
	//Выявление изменений
	if($_POST['name'] != $_POST['name_old'])
		array_push($changes_list, "`users`.`name`='".$_POST['name']."'");
	if($_POST['surname'] != $_POST['surname_old'])
		array_push($changes_list, "`users`.`surname`='".$_POST['surname']."'");
	if($_POST['fathname'] != $_POST['fathname_old'])
		array_push($changes_list, "`users`.`fathname`='".$_POST['fathname']."'");
	if($_POST['phone'] != $_POST['phone_old'])
		array_push($changes_list, "`users`.`phone`='".$_POST['phone']."'");
	if($_POST['passport'] != $_POST['passport_old'])
		array_push($changes_list, "`users`.`passport_seri_num`='".$_POST['passport']."'");
	if($_POST['autopassport'] != $_POST['autopasport_old'])
		array_push($changes_list, "`users`.`autopassport_seri_num`='".$_POST['autopassport']."'");
	if($_POST['credit_cart'] != $_POST['card_old'])
		array_push($changes_list, "`users`.`credit_card`='".$_POST['credit_cart']."'");
	if($_POST['address'] != $_POST['address_old'])
		array_push($changes_list, "`users`.`address`='".$_POST['address']."'");
	

	//Проверка цифровых полей
	check($_POST['passport'], 'passport');
	check($_POST['autopassport'], 'autopassport');
	check($_POST['credit_cart'], 'credit_cart');
	check($_POST['phone'], 'phone');
	
	//Проверка на пустоту
	if(($_POST['name']=='') or ($_POST['surname']=='') or ($_POST['fathname']=='') or ($_POST['passport']=='') or ($_POST['autopassport']=='') or ($_POST['credit_cart']=='') or($_POST['phone']=='') or ($_POST['address']==''))
	{
		array_push($ERROR_LIST, "Заполните все поля");	
	}

	//Если есть ошибки, то изменения не удались
	if(count($ERROR_LIST)>0)
		$_POST['change'] = $bad;
	//Иначе если есть данные для изменения - изменить
	elseif(count($changes_list)>0)
	{
		//сбор данных для изменения в переменную
		$UPDATE_string = implode(',',$changes_list);
		
		$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
		if($mysqli->connect_errno){
			echo "Ошибка подключения к бд".$mysqli->connect_errno;
			exit();
		}
		$res = $mysqli->query("UPDATE `users` SET $UPDATE_string WHERE  `users`.`id` = '".$_SESSION['uid']."'");
		$_POST['change'] = $good;
	}
}

//Если нажата кнопка 'Изменить данные' или 'Полная информация'
if($_POST['full_info'] or $_POST['change'])
{
	//попытка изменений была неудачна
	if($_POST['change']==$bad)
	{
		$page_content = renderTemplate('views/profile_change.php',['ERROR_LIST' => $ERROR_LIST,'nav_profile'=>$nav_profile,'person'=>$_POST,'bad_field'=>$bad_field]);
	}
	else
	{
		$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
		if($mysqli->connect_errno){
			echo "Ошибка подключения к бд".$mysqli->connect_errno;
			exit();
		}

		//Выбока всех данных по пользователю
		$res = $mysqli->query("SELECT `users`.`name`,`users`.`surname`,`users`.`fathname`,`users`.`phone`,`users`.`points`,`tariffs`.`name` as tname,`levels`.`name` as lname, `users`.`passport_seri_num` as passport, `users`.`autopassport_seri_num` as autopassport, `users`.`credit_card` as credit_cart, `users`.`address`
			FROM `users`
			INNER JOIN `tariffs` ON `tariffs`.`id` =`users`.`id_tariffs`
			INNER JOIN `levels` ON `levels`.`id` = `users`.`id_levels`  
			WHERE `users`.`id` = '".$_SESSION['uid']."'");
		$person = $res->fetch_assoc();

		//Отобразить страницу изменений
		if($_POST['change'])
			$page_content = renderTemplate('views/profile_change.php',['ERROR_LIST' => $ERROR_LIST,'nav_profile'=>$nav_profile,'person'=>$person]);
		//Отобразить страницу полной информации о пользователе
		elseif($_POST['full_info'])
			$page_content = renderTemplate('views/profile_full_info.php',['ERROR_LIST' => $ERROR_LIST,'nav_profile'=>$nav_profile,'person'=>$person,'$info_drive'=>$info_drive]);
	}
}
//Если нажата кнопка 'Мои поездки'
elseif($_POST['trips'])
{
	$rows_of_trips = [];
	
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}

	//Выборка данных о поездках пользователя
	$res = $mysqli->query("SELECT `trips`.`datetime_start` , `trips`.`datetime_end`, `trips`.`route`, `trips`.`coast` , `cars`.`brand`, `cars`.`model`, `cars`.`reg_number`, `cars`.`photo` FROM `trips` INNER JOIN `cars` ON `trips`.`id_cars`=`cars`.`id` WHERE `trips`.`id_users` = '".$_SESSION['uid']."'");
	while($row = $res->fetch_assoc())
	{
		array_push($rows_of_trips, $row);
	}
	$mysqli->close();
	
	//Отображение страницы 'Мои поездки'
	$page_content = renderTemplate('views/profile_trips.php',['ERROR_LIST' => $ERROR_LIST,'nav_profile'=>$nav_profile,'rows_of_trips'=>$rows_of_trips,'info_drive'=>$info_drive]);
	
}
//Иначе пользователь зашел на страницу 'Краткая информация'
else
{
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	//Выборка данных о пользователе
	$res = $mysqli->query("SELECT CONCAT(`users`.`surname`,' ',`users`.`name`,' ',`users`.`fathname`) as fullname,`users`.`phone`,`users`.`points`,`tariffs`.`name` as tname,`levels`.`name` as lname 
		FROM `users`
		INNER JOIN `tariffs` ON `tariffs`.`id` =`users`.`id_tariffs`
		INNER JOIN `levels` ON `levels`.`id` = `users`.`id_levels`  
		WHERE `users`.`id` = '".$_SESSION['uid']."'");
	$person = $res->fetch_assoc();
	
	//Отображение страницы 'Краткая информация'
	$page_content = renderTemplate('views/profile_short_info.php',['ERROR_LIST' => $ERROR_LIST,'nav_profile'=>$nav_profile,'display_window'=>$_SESSION['new_acc'],'person'=>$person,'info_drive'=>$info_drive]);
}

//Сборка страниц с шапкой иконтентом
$title = "Личный кабинет";
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
print($layout_content);
?>