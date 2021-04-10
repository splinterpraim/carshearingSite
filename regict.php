<?php 
session_start();
include("config/db.php");
require_once('function/functions.php');

//Variables
$start = false;
$created=false;
$bad_field = array();
$old_values = $_POST;

//Если был первый переход на страницу
if(!isset($_POST['regs']))
{
	//Проверка цифровых полей
	check($_POST['passport'], 'passport');
	check($_POST['autopassport'], 'autopassport');
	check($_POST['credit_cart'], 'credit_cart');
	check($_POST['phone'], 'phone');

	//Проверка на пустоту
	if(($_POST['name']=='') or ($_POST['surname']=='') or ($_POST['fathname']=='') or ($_POST['passport']=='') or ($_POST['autopassport']=='') or ($_POST['credit_cart']=='') or($_POST['phone']=='') or ($_POST['address']=='') or ($_POST['login_new']=='') or ($_POST['password_new']==''))
	{
		array_push($ERROR_LIST, "Заполните все поля");	
	}

	//Если прошли предыдущие проверки
	if(count($ERROR_LIST)<1)
	{
		$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
		if($mysqli->connect_errno){
			echo "Ошибка подключения к бд".$mysqli->connect_errno;
			exit();
		}

		//Проверка существование логина
		$res = $mysqli->query("SELECT `authorization`.`id` FROM `authorization` WHERE `authorization`.`login`= '".$_POST['login_new']."'");
		if($res->fetch_assoc())
		{
			$bad_field['login']=$ERROR_STYLE;
			array_push($ERROR_LIST, "Логин уже занят! Введите другой");
		}
		else
		{
			//Запрос на добавление пользователя
			$mysqli->query("INSERT INTO `users` (`id`, `name`, `surname`, `fathname`, `passport_seri_num`, `autopassport_seri_num`, `credit_card`, `photo`, `phone`, `address`, `status`, `points`, `id_tariffs`, `id_levels`) VALUES (NULL, '".$_POST['name']."', '".$_POST['surname']."', '".$_POST['fathname']."', '".$_POST['passport']."', '".$_POST['autopassport']."', '".$_POST['credit_cart']."', NULL, '".$_POST['phone']."', '".$_POST['address']."', NULL, '0', '1', '1');");

			$id_user = $mysqli->insert_id;

			//Запрос на добавление логина и пароля
			$mysqli->query("INSERT INTO `authorization` (`id`, `id_user`, `login`, `password`) VALUES (NULL, '".$id_user."', '".$_POST['login_new']."', '".$_POST['password_new']."');");
			
			$_SESSION['uid'] = $id_user;
			$_SESSION['name'] = $_POST['name'];
			$created = true;
		}
		$mysqli->close();
	}
}
//Если данные о новом пользователе добавлены в БД
if ($created)
{
	$_SESSION['new_acc']=true;
	header("Location: http://futucar/profile.php");
}
else
{
	$title = "Регистрация";
	$page_content = renderTemplate('views/regict.php',
								   ['ERROR_LIST' => $ERROR_LIST,
									'bad_field' => $bad_field,
									'old_values' => $_POST]); 

	$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
	print($layout_content);
}
?>
