<?php
session_start();

$rows_of_trips = [];
include("db.php");
$basaDB = new DB();
$basaDB->get_request("SELECT `trips`.`datetime_start` , `trips`.`datetime_end`, `trips`.`route`, `trips`.`coast` , `cars`.`brand`, `cars`.`model`, `cars`.`reg_number`, `cars`.`photo` FROM `trips` INNER JOIN `cars` ON `trips`.`id_cars`=`cars`.`id` WHERE `trips`.`id_users` = '".$_SESSION['uid']."'");
while($row = $basaDB->unpacking())
{
	array_push($rows_of_trips, $row);
}
 unset($basaDB);

 
/*SELECT `trips`.`datetime_start` , `trips`.`datetime_end`, `trips`.`route`, `trips`.`coast` , `cars`.`brand`, `cars`.`model`, `cars`.`reg_number`, `cars`.`photo` FROM `trips` INNER JOIN `cars` ON `trips`.`id_cars`=`cars`.`id` WHERE `trips`.`id_users` = '15'*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lab3 show trips</title>
</head>
<body bgcolor="#D8BFD8">
	<div style="float: right;">
	<form action="index.php">
		<input type="submit" name="main" value="На Главную">
	</form>
	</div> 
	<div  align="center" style="padding-left: 80px;">
		<span style="text-align: center; font-family: Impact;font-size: 35px;background: #32CD32;  " >   Ваши поездки</span> <br><br>
	</div>
<?php if(!count($rows_of_trips)){

?>
	<div  align="center" >
		<span style="text-align: center; font-family: Lucida Sans Unicode;font-size: 20px;  " >_ _ У вас еще нет поездок _ _</span> <br><br>
	</div>
<?php } else{?>
	<div align="center" style="">
		
		<?php foreach ($rows_of_trips  as  $value){ 
			$reg="/(:)/";
			$new_value_route =preg_split($reg, $value['route']);
			?>
			<table  width="500"  style="height: 200px; border: 1px solid black;">	
			<tr>
				<td bgcolor="#D3D3D3"><b><?php echo $value['reg_number'];?></b></td>
				<td bgcolor="#FFA500" width="20%" ><b><?php echo $value['brand'].' '.$value['model'];?></b></td>
			</tr>
			<tr>
				<td bgcolor="#F4A460" colspan="2" >
					<?php 
						echo "<span style=\"font-family: Century Gothic;\">".$value['datetime_start'].'</span><br>';
						echo "<span style=\"font-family: Tahoma;\">".$new_value_route[0].'</span>';
					?>	
				</td>
				
			</tr>
			<tr>
				<td  colspan="2" align="center"> <img height="50" src="img/arrow.png"></td>
			</tr>
			<tr>
				<td bgcolor="#00FA9A" colspan="2" >
					<?php 
						echo "<span style=\"font-family: Century Gothic;\">".$value['datetime_end'].'</span><br>';
						echo "<span style=\"font-family: Tahoma;\">".$new_value_route[1].'</span>';
					?>	
				</td>
			</tr>
			<tr>
				<td align="center"  colspan="2"><?php echo "<img src=\"img\\".$value['photo'] ."\" height=\"200\">";?></td>
			</tr>
			<tr bgcolor="#00FFFF">
				<td>Стоимость:</td>
				<td ><?php echo $value['coast'];?> Руб</td>
			</tr>
			</table>
			<br><br>
		<?php } ?>
	</div>
<?php }?>
</body>
</html>