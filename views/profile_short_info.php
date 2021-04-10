<?php session_start();?>
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
		<br>
		<h4><?=$person['fullname']?></h4>
		<div>Телефон: <?=$person['phone']?></div>
		<div>Уровень: <?=$person['lname']?></div>
		<div>Баллы: <?=$person['points']?></div>
		<div>Тариф: <?=$person['tname']?></div>

	</div>
</div>