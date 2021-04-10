<div>
	<form></form>
	<form method="post" action="">
		<?php foreach($nav_profile as $key => $value):?>
		<input type="submit" name="<?=$key?>" value="<?=$value?>">
		<?php endforeach;?>
	</form>
	<h3>Изменить информацию об аккаунте</h3>
	<form method="post" action="">
	<div>
		<input type="hidden" name="form" value="make_change">
		<input type="hidden" name="name_old" value="<?=$person['name']?>">
		<input type="hidden" name="surname_old" value="<?=$person['surname']?>">
		<input type="hidden" name="fathname_old" value="<?=$person['fathname']?>">
		<input type="hidden" name="phone_old" value="<?=$person['phone']?>">
		<input type="hidden" name="passport_old" value="<?=$person['passport']?>">
		<input type="hidden" name="autopassport_old" value="<?=$person['autopassport']?>">
		<input type="hidden" name="credit_cart_old" value="<?=$person['credit_cart']?>">
		<input type="hidden" name="address_old" value="<?=$person['address']?>">
		<table>
		<tr>
			<td>Имя:</td> <td><input type="text" name="name" value="<?=$person['name']?>"></td>
		</tr>
		<tr>
			<td>Фамилия:</td> <td><input type="text" name="surname" value="<?=$person['surname']?>"></td>
		</tr>
		<tr>
			<td>Отчество:</td><td><input type="text" name="fathname" value="<?=$person['fathname']?>"></td>
		</tr>
		<tr>
			<td>Телефон:</td><td><input style="<?=$bad_field['phone'];?>" type="text" name="phone" value="<?=$person['phone']?>"></td>
		</tr>
		<tr>
			<td>Паспорт:</td><td><input style="<?=$bad_field['passport'];?>" type="text" name="passport" value="<?=$person['passport']?>"></td>
		</tr>
		<tr>
			<td>Автомобильные права:</td><td><input style="<?=$bad_field['autopassport'];?>" type="text" name="autopassport" value="<?=$person['autopassport']?>"></td>
		</tr>
		<tr>
			<td>Кредитная карта:</td><td><input style="<?=$bad_field['credit_cart'];?>" type="text" name="credit_cart" value="<?=$person['credit_cart']?>"></td>
		</tr>
		<tr>
			<td>Адрес:</td><td><textarea type="text" name="address" rows="3" cols="30"><?=$person['address']?></textarea></td>
		</tr>

		</table>
		<input type="submit" name="make_change" value="Сохранить">
	</div>
	</form>
	<div>
	<?php foreach($ERROR_LIST as $one_err):?>
			<h3 style="color: red;"><?=$one_err;?></h3>
	<?php endforeach; ?>
	</div>
</div>