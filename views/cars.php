

<div style="padding-top: 10px; text-align: center; border: 1px solid #333; width: 35%; box-shadow: 8px 8px 5px #444; height: 30px">
	<form action="cars.php" method="post">
		Город:
		<select name="cities">
			<option>Все</option>
			<?php foreach ($rows_of_city  as  $row): ?>
				<?php if($selected_city==$row['name']): ?>
					<option selected><?=$row['name']; ?></option>
				<?php else: ?>
					<option><?=$row['name'];?></option>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
	
		Фильтр:
		<select name="filter">
				<?php if($filter_of_sort=="По убыванию цены"): ?>
					<option>По возрастанию цены</option>
					<option selected>По убыванию цены</option>
				<?php else: ?>
					<option selected>По возрастанию цены</option>
					<option>По убыванию цены</option>
				<?php endif; ?>
		</select>
		<input type="submit" name="butt" value="Найти">
	</form>
	</div>
	
	<br>
	<div align="" style="padding-left: 30px;">
		
		<?php foreach ($rows_of_car  as  $value): ?>
			<table  width="500" style="border: 1px solid black;">	
			<tr>
				<td bgcolor="#FFA500" width="20%" ><b><?=$value['brand'].' '.$value['model'];?></b></td>
				<td bgcolor="#D3D3D3"><b><?=$value['city'];?></b></td>
				<td bgcolor="#00FA9A"><?=$value['price_to_min'];?> руб/мин</td>
			</tr>
			<tr>
				<td bgcolor="#FFE4E1"><?=$value['reg_number'];?></td>
				<td align="center" rowspan="3" colspan="2"><img src="img/<?=$value['photo']?>" height="200"> </td>
					
			</tr>
			<tr>
				<td bgcolor="#FFE4E1">Бензин: <?=$value['petrol_count'];?>%</td>
			</tr>
			<tr>
				<td bgcolor="#FFE4E1">Уровень: <?=$value['levels'];?></td>
			</tr>
			<tr bgcolor="#00FFFF">
				<td>Местоположение:</td>
				<td colspan="2"><?=$value['location'];?></td>
			</tr>
			</table>
			<br>
		<?php endforeach; ?>
	</div>
