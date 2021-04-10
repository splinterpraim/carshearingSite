<?php session_start();?>
<?php if($_SESSION['drive']=='true'):?>

<h4>Ну что пасаны , погнали</h4>
<div>
	<form method="post" action="">
		
		<input type="submit" name="stop" value="Закончить">
	</form>
</div>

<?php else: ?>
<h4>Последние приготовления</h4>
<div>
	<form method="post" action="">
		Введите адрес назначения: <input type="text" name="to">
		<input type="submit" name="start" value="Поехать">
	</form>
</div>
<?php endif;?>