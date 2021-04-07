
	<div>
		<form></form>
		<form action="" method="post">
			<table>
				<tr>
					<td>Имя:</td>
					<td><input type="text" name="name" value= "<?=$name;?>"  ></td>
				</tr>
				<tr>
					<td>Фамилию:</td>
					<td><input type="text" name="surname" value= "<?=$surname;?>" ></td>
				</tr>
				<tr>
					<td>Отчество:</td>
					<td><input type="text" name="fathname" value= "<?=$fathname;?>" ></td>
				</tr>
				<tr>
					<td >Паспорт (серия/номер):</td>
					<td><input class="<?=$check['pasport'];?>" type="text" name="pasport"  value= "<?=$pasport;?>"></td>
				</tr>
				<tr>
					<td>Номер водительского<br> удостоверения:</td>
					<td><input class="<?=$check['autopasport'];?>" type="text" name="autopasport" value="<?=$autopasport;?>" ></td>
				</tr>
				<tr>
					
					<td>Номер кредитной карты:</td>
					<td><input  class="<?=$check['credit_cart'];?>" type="text" name="credit_cart"  value="<?=$credit_cart;?>" ></td>
				</tr>
				<tr>
					<td>Номер телефона:</td>
					<td><input class="<?=$check['phone'];?>" type="text" name="phone" value="<?=$phone;?>" ></td>
				</tr>
				<tr>
					<td>Адрес:</td>
					<td><input type="text" name="address" value="<?=$address;?>"></td>
				</tr>
				<tr>
					<td>Логин:</td>
					<td><input type="text" name="login_new" value="<?=$login_new;?>"></td>
				</tr>
				<tr>
					<td>Пароль:</td>
					<td><input type="text" name="password_new" value="<?=$password_new;?>"></td>
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
