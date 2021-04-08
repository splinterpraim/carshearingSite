<div>
	<?php if($display_window): ?>
		 <div>Поздравляю ты создал аккаунт</div>
	<?php endif; ?>
	<form></form>
	<form method="post" action="">
		<?php foreach($nav_profile as $key => $value):?>
		<input type="submit" name="<?=$key?>" value="<?=$value?>">
		<?php endforeach;?>
	</form>
	<div>
		<h3><?=$fulname?></h3>
		<div>Телефон:</div>
		<div>Уровень:</div>
		<div>Баллы:</div>
		<div>Тариф:</div>
		
		


	</div>
</div>