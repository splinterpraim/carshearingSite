<?php 
session_start();
$start = false;
$Good = true;
$class_er = "er";
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



$reg = preg_match_all($regular, $name);
if($reg > 0 )
{
	$check['pasport']=$class_er;
	$Good=false;
	$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";
}
$reg = preg_match_all($regular,$surname);
if($reg > 0 )
{
	$check['autopasport']=$class_er;
	if($Good) {$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}
$reg = preg_match_all($regular,$credit_cart);
if($reg > 0 )
{
	$check['credit_cart']=$class_er;
	if($Good){ $errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}
$reg = preg_match_all($regular,$phone);
if($reg > 0 )
{
	$check['phone']=$class_er;
	if($Good) {$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}


if(!(isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['fathname']) and isset($_POST['pasport']) and isset($_POST['autopasport']) and isset($_POST['credit_cart']) and isset($_POST['phone']) and isset($_POST['address']) and isset($_POST['login_new']) and isset($_POST['password_new'])))
{
	
	$start=true;
}
elseif(($_POST['name']=='') or ($_POST['surname']=='') or ($_POST['fathname']=='') or ($_POST['pasport']=='') or ($_POST['autopasport']=='') or ($_POST['credit_cart']=='') or ($_POST['phone']=='') or ($_POST['address']=='') or ($_POST['login_new']=='') or ($_POST['password_new']==''))
{
	
	$Good=false;
	$errors .= "<span style=\"color: #FF8C00;\">Заполните все поля</span><br>";
	
}

/*
$created=false;
if($Good and !$start)
{
	include("db.php");
	$basaDB = new DB();
	$basaDB->get_request("INSERT INTO `users` (`id`, `name`, `surname`, `fathname`, `passport_seri_num`, `autopassport_seri_num`, `credit_card`, `photo`, `phone`, `address`, `status`, `points`, `id_tariffs`, `id_levels`) VALUES (NULL, '".$_POST['name']."', '".$_POST['surname']."', '".$_POST['fathname']."', '".$_POST['pasport']."', '".$_POST['autopasport']."', '".$_POST['credit_cart']."', NULL, '".$_POST['phone']."', '".$_POST['address']."', NULL, '0', '1', '1');");
	$basaDB->get_request("  SELECT `users`.`id`
							FROM `users`
							WHERE  `users`.`name`='".$_POST['name']."' AND  `users`.`surname`='".$_POST['surname']."' AND `users`.`fathname`='".$_POST['fathname']."' AND `users`.`passport_seri_num`='".$_POST['pasport']."' AND `users`.`autopassport_seri_num`='".$_POST['autopasport']."' AND  `users`.`credit_card`='".$_POST['credit_cart']."' AND  `users`.`phone`='".$_POST['phone']."' AND  `users`.`address`='".$_POST['address']."';");
	$id_user = $basaDB->unpacking();
	$basaDB->get_request("INSERT INTO `authorization` (`id`, `id_user`, `login`, `password`) VALUES (NULL, '".$id_user['id']."', '".$_POST['login_new']."', '".$_POST['password_new']."');");
	unset($basaDB);
	$_SESSION['uid'] = $id_user['id'];
	$created = true;
}
if ($created)
{
	include('msg_create_acc.php');
}
else
{

}
*/

?>
