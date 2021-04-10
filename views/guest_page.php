
<div>
	<h6>Отзывы наших пользователей</h6>
	<div style="overflow:scroll;  margin-left: 100px;  border: 4px solid black; height: 400px; width: 900px;">
	<?php foreach($messages as $one_msg): ?>

		<div style="width: 80%" >
			<div  style="display: flex; align-items: flex-start;">
				<div style="margin-bottom: 0; border: 2px solid black;  border-radius: 10px; background-color: #d6b8b8;">
					<?=$one_msg['who']?></div>
				<div style="padding-left: 5px"><?=$one_msg['data_msg']?></div>
			</div> 
			<div style="display: flex; align-items: flex-start;">
			 	<div style="margin-left: 10px; border: 2px solid black; background-color: <?=$msg_colors[rand(0,3)]?>"><?=$one_msg['msg']?></div>
			 </div>
		</div>
		<br>
	<?php endforeach;?>

	</div>

	<div style="margin-top: 20px; margin-left: 100px">
		Введите сообщение:
		<form method="post" action="">
			<textarea placeholder="ваше сообщене" rows="2" cols="100" name='msg_text'></textarea>
			<input type="submit" name="msg">
		</form>
	</div>
	<br>
</div>