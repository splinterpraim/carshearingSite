<div>
	<form></form>
	<form  method="post" action="">
		<?php foreach($nav_profile as $key => $value):?>
		<input type="submit" name="<?=$key?>" value="<?=$value?>">
		<?php endforeach;?>
	</form>
	<div>
		<div  align="center" style="padding-left: 80px;">
		<span style="text-align: center; font-family: Impact;font-size: 35px;background: #32CD32;">   Ваши поездки</span> <br><br>
		</div>
	</div>
	<?php if(!count($rows_of_trips)): ?>
	<div  align="center" >
			<span style="text-align: center; font-family: Lucida Sans Unicode;font-size: 20px;  " >_ _ У вас еще нет поездок _ _</span> <br><br>
	</div>
	<?php else: ?>
		<div align="center" style="">
			<?php foreach ($rows_of_trips  as  $value):
				$reg="/(:)/";
				$new_value_route =preg_split($reg, $value['route']); ?>
				<table  width="500"  style="height: 200px; border: 1px solid black;">	
				<tr>
					<td bgcolor="#D3D3D3"><b><?=$value['reg_number'];?></b></td>
					<td bgcolor="#FFA500" width="20%" ><b><?=$value['brand'].' '.$value['model'];?></b></td>
				</tr>
				<tr>
					<td bgcolor="#F4A460" colspan="2" >
						<span style="font-family: Century Gothic;"><?=$value['datetime_start'];?></span><br>
						<span style="font-family: Tahoma;"><?=$new_value_route[0];?></span>	
					</td>
				</tr>
				<tr>
					<td  colspan="2" align="center"> <img height="50" src="img/arrow.png"></td>
				</tr>
				<tr>
					<td bgcolor="#00FA9A" colspan="2" >
						<span style="font-family: Century Gothic;"><?=$value['datetime_end'];?></span><br>
						<span style="font-family: Tahoma;"><?=$new_value_route[1];?></span>
					</td>
				</tr>
				<tr>
					<td align="center"  colspan="2">
						<img src="img/<?=$value['photo'];?>" height="200">
					</td>
				</tr>
				<tr bgcolor="#00FFFF">
					<td>Стоимость:</td>
					<td ><?=$value['coast'];?> Руб</td>
				</tr>
				</table>
				<br><br>
			<?php endforeach;?>
			
		</div>
	<?php endif; ?>
</div>






	