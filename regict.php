<?php 
session_start();
//
$start = false;
$Good = true;
$style_er = "background: red;";
$errors = "";
$check = ['pasport'=>'','autopasport'=>'','credit_cart'=>'','phone'=>'']; 
$regular = "/\D/";



//Variables
$name = $_POST['name'];
$surname = $_POST['surname'];
$fathname = $_POST['fathname'];
$pasport = $_POST['pasport'];
$autopasport = $_POST['autopasport'];
$credit_cart = $_POST['credit_cart'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$login_new = $_POST['login_new'];
$password_new = $_POST['password_new'];
$error_list = array();
//



$reg = preg_match_all($regular, $pasport);
if($reg > 0 )
{
	$check['pasport']=$style_er;
	$Good=false;
	array_push($error_list, "Вы можете вводить только цифры в эти поля");
	//$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";
}
$reg = preg_match_all($regular,$autopasport);
if($reg > 0 )
{
	$check['autopasport']=$style_er;
	if (count($error_list)<1) {
		array_push($error_list, "Вы можете вводить только цифры в эти поля");
	}
	
	//if($Good) {$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}
$reg = preg_match_all($regular,$credit_cart);
if($reg > 0 )
{
	$check['credit_cart']=$style_er;
	if (count($error_list)<1) {
		array_push($error_list, "Вы можете вводить только цифры в эти поля");
	}
	//if($Good){ $errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}
$reg = preg_match_all($regular,$phone);
if($reg > 0 )
{
	$check['phone']=$style_er;
	if (count($error_list)<1) {
		array_push($error_list, "Вы можете вводить только цифры в эти поля");
	}
	//if($Good) {$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}


if(!(isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['fathname']) and isset($_POST['pasport']) and isset($_POST['autopasport']) and isset($_POST['credit_cart']) and isset($_POST['phone']) and isset($_POST['address']) and isset($_POST['login_new']) and isset($_POST['password_new'])))
{
	
	$start=true;
}
elseif(($_POST['name']=='') or ($_POST['surname']=='') or ($_POST['fathname']=='') or ($_POST['pasport']=='') or ($_POST['autopasport']=='') or ($_POST['credit_cart']=='') or ($_POST['phone']=='') or ($_POST['address']=='') or ($_POST['login_new']=='') or ($_POST['password_new']==''))
{
	
	$Good=false;
	//$error_list = array();
	array_push($error_list, "Заполните все поля");
	
	//$errors .= "<span style=\"color: #FF8C00;\">Заполните все поля</span><br>";
	
}


$created=false;
if($Good and !$start)
{
	include("config/db.php");
	$mysqli = new mysqli($DATABASE_URL,$USER,$USER_PASSWORD,$DATABASE);
	if($mysqli->connect_errno){
		echo "Ошибка подключения к бд".$mysqli->connect_errno;
		exit();
	}
	$mysqli->query("INSERT INTO `users` (`id`, `name`, `surname`, `fathname`, `passport_seri_num`, `autopassport_seri_num`, `credit_card`, `photo`, `phone`, `address`, `status`, `points`, `id_tariffs`, `id_levels`) VALUES (NULL, '".$name."', '".$surname."', '".$fathname."', '".$pasport."', '".$autopasport."', '".$credit_cart."', NULL, '".$phone."', '".$address."', NULL, '0', '1', '1');");

	/*$basaDB->get_request("  SELECT `users`.`id`
							FROM `users`
							WHERE  `users`.`name`='".$_POST['name']."' AND  `users`.`surname`='".$_POST['surname']."' AND `users`.`fathname`='".$_POST['fathname']."' AND `users`.`passport_seri_num`='".$_POST['pasport']."' AND `users`.`autopassport_seri_num`='".$_POST['autopasport']."' AND  `users`.`credit_card`='".$_POST['credit_cart']."' AND  `users`.`phone`='".$_POST['phone']."' AND  `users`.`address`='".$_POST['address']."';");*/
	$id_user = $mysqli->insert_id;
	$mysqli->query("INSERT INTO `authorization` (`id`, `id_user`, `login`, `password`) VALUES (NULL, '".$id_user."', '".$_POST['login_new']."', '".$_POST['password_new']."');");
	$mysqli->close();
	$_SESSION['uid'] = $id_user;
	$_SESSION['name'] = $name;
	$created = true;
}
if ($created)
{
	$_SESSION['new_acc']=true;
	header("Location: http://futucar/profile.php");
}
else
{



require_once('functions.php');
$title = "Регистрация";


$page_content = renderTemplate('views/regict.php',['error_list' => $error_list,
								'check' => $check,
								'name'=> $name,
								'surname'=>$surname,
								'fathname' => $fathname,
								'pasport'=>$pasport,
								'autopasport'=>$autopasport,
								'credit_cart'=>$credit_cart,
								'phone'=>$phone,
								'address'=>$address,
								'login_new'=>$login_new,
								'password_new'=>$password_new]); 
//include 'views/layout.php';
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
print($layout_content);
}
?>
