<?php session_start();?>


<div>
	спасибо за поездку
	<p>Ваша стоимость: <?=$coast?> руб</p>
	<p>Ваше время: <?=$time?> мин</p>
	<form method="post" action="index.php">
		<input type="submit" name="back_in_main" value="Вернутся на главную">
	</form>
</div>