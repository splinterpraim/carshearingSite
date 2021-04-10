<div style="padding-left: 50px;">
	<?php foreach($cities as $city): ?>
	<div>
		<h4><?=$city['name']?></h4>
		<ul>
			<li><h6>Адрес офиса: <?=$city['office']?></h6></li>
			<li><h6>Номер телефона: <?=$city['phone']?></h6></li>
		</ul>
		</div>
	<?php endforeach;?>
</div> <br>
<div>
	<h5>Если у вас есть вопросы, вы можете написать в службу подержки используя следующую форму</h5>

	<form method="post" action="" style="padding-left: 50px;">
		Укажите вашу почту для ответа: <input type="text" name="umail"><br><br>
		 <textarea placeholder="Ваше сообщение" rows="10" cols="50" name="msg"></textarea>
		 <input type="submit" name="Отправить">
	</form><br>
</div>