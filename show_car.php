<?php 

include("db.php");

$rows_of_car = array();
$sort_car = 'ASC';
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
 ?>
 


<!DOCTYPE html>
<html>
<head>
	<title>Lab2 cars</title>
</head>
<body bgcolor="#D8BFD8">
	<div style="float: right;">
	<form action="index.php">
		<input type="submit" name="main" value="На Главную">
	</form>
	</div> 
	<div style="padding-top: 10px; text-align: center; border: 1px solid #333; width: 35%; box-shadow: 8px 8px 5px #444; height: 30px">
	<form action="show_car.php" method="post">
		Город:
		<select name="cities">
			<option>Все</option>

			<?php 
			while($row = $basaDB->unpacking())
			{
				if($_POST["cities"]==$row['name'])
				{
					echo "<option selected>".$row['name']."</option>";
				}
				else
				{
					echo "<option>".$row['name']."</option>";
				}	
			}
			?>
		</select>
		Фильтр:
		<select name="filter">
			<?php 
				if($_POST["filter"]=="По убыванию цены")
				{
					echo "<option>По возрастанию цены</option>";
					echo "<option selected>По убыванию цены</option>";
				}
				else
				{
					echo "<option selected>По возрастанию цены</option>";
					echo "<option>По убыванию цены</option>";
				}
				
			?>
		</select>
		<input type="submit" name="butt" value="Найти">
	</form>
	</div>
	
	<br>
	<div align="" style="padding-left: 30px;">
		
			<?php foreach ($rows_of_car  as  $value) { ?>
			<table  width="500" style="border: 1px solid black;">	
			<tr>
				<td bgcolor="#FFA500" width="20%" ><b><?php echo $value['brand'].' '.$value['model'];?></b></td>
				<td bgcolor="#D3D3D3"><b><?php echo $value['city'];?></b></td>
				<td bgcolor="#00FA9A"><?php echo $value['price_to_min'];?> руб/мин</td>
			</tr>
			<tr>
				<td bgcolor="#FFE4E1"><?php echo $value['reg_number'];?></td>
				<td align="center" rowspan="3" colspan="2"><?php echo "<img src=\"img\\".$value['photo'] ."\" height=\"200\">";?></td>
			</tr>
			<tr>
				<td bgcolor="#FFE4E1">Бензин: <?php echo $value['petrol_count'];?>%</td>
			</tr>
			<tr>
				<td bgcolor="#FFE4E1">Уровень: <?php echo $value['levels'];?></td>
			</tr>
			<tr bgcolor="#00FFFF">
				<td>Местоположение:</td>
				<td colspan="2"><?php echo $value['location'];?></td>
			</tr>
			</table>
			<br>
		<?php } ?>
	</div>
</body>
</html>

<?php  unset($basaDB);?>