<?php session_start();?>
<?php if($_SESSION['drive']=='true'):?>

<h4>В пути</h4>
<div style="text-align: center;">
	Сумма: <h3><?=$coast?> руб</h3>
	Время: <h3><?=$time?> мин</h3>
	<div align="center" style="">
				
				<table  width="500"  style="height: 200px; border: 1px solid black;">	
				<tr>
					<td bgcolor="#D3D3D3"><b><?=$onecar['reg_number'];?></b></td>
					<td bgcolor="#FFA500" width="20%" ><b><?=$onecar['brand'].' '.$onecar['model'];?></b></td>
				</tr>
				<tr>
					<td bgcolor="#F4A460" colspan="2" style="text-align: center;">
								
						<span style="font-family: Tahoma;"><?=$new_value_route[0];?></span>	
					</td>
				</tr>
				<tr>
					<td  colspan="2" align="center"> <img height="50" src="img/arrow.png"></td>
				</tr>
				<tr>
					<td bgcolor="#00FA9A" colspan="2" style="text-align: center;" >
						<span style="font-family: Tahoma;"><?=$new_value_route[1];?></span>
					</td>
				</tr>
				<tr>
					<td align="center"  colspan="2">
						<img src="img/<?=$onecar['photo'];?>" height="200">
					</td>
				</tr>
				<tr>
					<td colspan="2" ><span style="background-color: #00FA9A">Бензин: <?=$new_petrol?> %</span></td>
				</tr>
				
				</table>
				<br>
		</div>
	<form method="post" action="">
		<input type="submit" name="stop" value="Закончить">
	</form>
	<br>
</div>

<?php else: ?>
<h4>Последние приготовления</h4>
<div>
	<form method="post" action="">
		Введите адрес назначения: <input type="text" name="to">
		<input type="hidden" name="id_car" value="<?=$onecar['id'];?>">
		<input type="submit" name="start" value="Поехать">
	</form>
	Выбранная машина
	<div align="" style="padding-left: 250px;">
			<div style="display:inline-block; float:left;">
			<table  width="500" style="border: 1px solid black;">	
			<tr>
				<td bgcolor="#FFA500" width="20%" ><b><?=$onecar['brand'].' '.$onecar['model'];?></b></td>
				<td bgcolor="#D3D3D3"><b><?=$onecar['city'];?></b></td>
				<td bgcolor="#00FA9A"><?=$onecar['price_to_min'];?> руб/мин</td>
			</tr>
			<tr>
				<td bgcolor="#FFE4E1"><?=$onecar['reg_number'];?></td>
				<td align="center" rowspan="3" colspan="2"><img src="img/<?=$onecar['photo']?>" height="200"> </td>
					
			</tr>
			<tr>
				<td bgcolor="#FFE4E1">Бензин: <?=$onecar['petrol_count'];?>%</td>
			</tr>
			<tr>
				<td bgcolor="#FFE4E1">Уровень: <?=$onecar['levels'];?></td>
			</tr>
			<tr bgcolor="#00FFFF">
				<td>Местоположение:</td>
				<td colspan="2"><?=$onecar['location'];?></td>
			</tr>
			</table>
			</div>
		
	</div>
</div>
<?php endif;?>