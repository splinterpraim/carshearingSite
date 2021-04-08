<div align="center">
	
	<?php if($dont_access): ?>
		 <div>Для доступа тебе нужно войти в аккаунт</div>
	<?php endif; ?>
</div>
<div style="padding-top: 100px;">
	<form></form>
	<div>
		<form action="" method="post">
			
			<table  align="center">
				<tr>
					<td>Логин:</td>
					<td><input type="text" name="login"></td>
				</tr><br>
				<tr>
					<td>Пароль:</td>
					<td><input type="text" name="password"></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><input type="submit" name="autorization" value="Вход"></td>
				</tr>
			</table>
		</form>
	</div>
	
	<div align="center">
		<form action="regict.php" method="post"><input type="submit" name="regs" value="Зарегестрироваться"></form>
	</div>
	<div>
		<?php foreach($error_list as $er): ?>
			<div><?=$er?></div>
		<?php endforeach; ?>
	</div>
</div>
