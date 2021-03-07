<?php 
session_start();
$start = false;
$Good = true;
$class_er = "class=\"er\"";
$errors = "";
$check = ['pasport'=>'','autopasport'=>'','credit_cart'=>'','phone'=>'']; 
$regular = "/\D/";
$reg = preg_match_all($regular,$_POST['pasport']);
if($reg > 0 )
{
	$check['pasport']=$class_er;
	$Good=false;
	$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";
}
$reg = preg_match_all($regular,$_POST['autopasport']);
if($reg > 0 )
{
	$check['autopasport']=$class_er;
	if($Good) {$errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}
$reg = preg_match_all($regular,$_POST['credit_cart']);
if($reg > 0 )
{
	$check['credit_cart']=$class_er;
	if($Good){ $errors .= "<span style=\"color: red;\">Вы можете вводить только цифры в эти поля</span><br>";$Good=false;}
}
$reg = preg_match_all($regular,$_POST['phone']);
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



?>

<!DOCTYPE html>
<html>
<head>
	<title>Lab3 create user</title>
	<style type="">
		.er{
			background: #FA8072;
		}
	</style>
</head>
<body bgcolor="#90EE90">
	<div style="float: right;">
	<form action="log_out.php" method="post">
		<input type="submit" name="main" value="Назад">
	</form>
	</div> 
	<div>
		<form action="creat_new_account.php" method="post">
			<table>
				<tr>
					<td>Имя:</td>
					<td><input type="text" name="name" <?php echo "value=\"".$_POST['name']."\""?>></td>
				</tr>
				<tr>
					<td>Фамилию:</td>
					<td><input type="text" name="surname" <?php echo "value=\"".$_POST['surname']."\""?>></td>
				</tr>
				<tr>
					<td>Отчество:</td>
					<td><input type="text" name="fathname" <?php echo "value=\"".$_POST['fathname']."\""?>></td>
				</tr>
				<tr>
					<td >Паспорт (серия/номер):</td>
					<td><input <?php echo $check['pasport'];?> type="text" name="pasport" <?php echo "value=\"".$_POST['pasport']."\""?>></td>
				</tr>
				<tr>
					<td>Номер водительского<br> удостоверения:</td>
					<td><input <?php echo $check['autopasport'];?> type="text" name="autopasport" <?php echo "value=\"".$_POST['autopasport']."\""?>></td>
				</tr>
				<tr>
					
					<td>Номер кредитной карты:</td>
					<td><input  <?php echo $check['credit_cart'];?> type="text" name="credit_cart" <?php echo "value=\"".$_POST['credit_cart']."\""?>></td>
				</tr>
				<tr>
					<td>Номер телефона:</td>
					<td><input <?php echo $check['phone'];?> type="text" name="phone" <?php echo "value=\"".$_POST['phone']."\""?>></td>
				</tr>
				<tr>
					<td>Адрес:</td>
					<td><input type="text" name="address" <?php echo "value=\"".$_POST['address']."\""?>></td>
				</tr>
				<tr>
					<td>Логин:</td>
					<td><input type="text" name="login_new" <?php echo "value=\"".$_POST['login_new']."\""?>></td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td><input type="text" name="password_new" <?php echo "value=\"".$_POST['password_new']."\""?>></td>
				</tr>
			</table>
			<input type="submit" name="butt" value="Создать">
		</form>
		<br>
	</div>
	<div <?php if(($Good==false)and($start==false)){?>style="border: 4px solid #20B2AA; width: 300px; font-size: 20px;"<?php }?>>
		<?php echo '<b>'.$errors.'<b>';?>
	</div>
	
</body>
</html>

<?php 
	}
?>