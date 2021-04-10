<div>
	<form></form>
	<form method="post" action="">
		<?php foreach($nav_profile as $key => $value):?>
		<input type="submit" name="<?=$key?>" value="<?=$value?>">
		<?php endforeach;?>
	</form>
	<h3>Полная информация</h3>
	<div>
		<div>Имя: <?=$person['name']?></div>
		<div>Фамилия: <?=$person['surname']?></div>
		<div>Отчество: <?=$person['fathname']?></div>
		<div>Телефон: <?=$person['phone']?></div>
		<div>Пасспорт: <?=$person['passport']?></div>
		<div>Автомобильные права: <?=$person['autopassport']?></div>
		<div>Кредитная карта: <?=$person['credit_cart']?></div>
		<div>Адрес: <?=$person['address']?></div>
		<div>Уровень: <?=$person['lname']?></div>
		<div>Баллы: <?=$person['points']?></div>
		<div>Тариф: <?=$person['tname']?></div>
		
		


	</div>
	
</div>