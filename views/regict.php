<div>
	<div>
		<form></form>
		<form action="" method="post">
			<table>
				<tr>
					<td>Имя:</td>
					<td><input type="text" name="name" value= "<?=$old_values['name'];?>"  ></td>
				</tr>
				<tr>
					<td>Фамилию:</td>
					<td><input type="text" name="surname" value= "<?=$old_values['surname'];?>" ></td>
				</tr>
				<tr>
					<td>Отчество:</td>
					<td><input  type="text" name="fathname" value= "<?=$old_values['fathname'];?>" ></td>
				</tr>
				<tr>
					<td >Паспорт (серия/номер):</td>
					<td><input style="<?=$bad_field['passport'];?>" type="text" name="passport"  value= "<?=$old_values['passport'];?>"></td>
				</tr>
				<tr>
					<td>Номер водительского<br> удостоверения:</td>
					<td><input style="<?=$bad_field['autopassport'];?>" type="text" name="autopassport" value="<?=$old_values['autopassport'];?>" ></td>
				</tr>
				<tr>
					
					<td>Номер кредитной карты:</td>
					<td><input  style="<?=$bad_field['credit_cart'];?>" type="text" name="credit_cart"  value="<?=$old_values['credit_cart'];?>" ></td>
				</tr>
				<tr>
					<td>Номер телефона:</td>
					<td><input style="<?=$bad_field['phone'];?>" type="text" name="phone" value="<?=$old_values['phone'];?>" ></td>
				</tr>
				<tr>
					<td>Адрес:</td>
					<td><input type="text" name="address" value="<?=$old_values['address'];?>"></td>
				</tr>
				<tr>
					<td>Логин:</td>
					<td><input   style="<?=$bad_field['login'];?>" type="text" name="login_new" value="<?=$old_values['login_new'];?>"></td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td><input type="text" name="password_new" value="<?=$old_values['password_new'];?>"></td>
				</tr>
			</table>
			<input type="submit" name="butt" value="Создать">
		</form>
		<br>
	</div>


	<div>
	<?php foreach($ERROR_LIST as $one_err):?>
			<h3 style="color: red;"><?=$one_err;?></h3>
	<?php endforeach; ?>
	</div>
</div>
