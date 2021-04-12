
<?php if($tariffs):?>

	<ul style="margin-left: 200px">
	<?php foreach($tariffs as $one):?>
		<li style="margin-bottom: 10px">
			<h4 style="background-color: #d9d325; width: 500px;margin-bottom: 0"><?=$one['name']?></h4>
			<div style="border: 1px solid black; width: 500px">
			<p style="width: 100%; font-size: 18px"><?=$one['discription']?></p>
			<div  style="border: 1px solid black;">
				Изменение общей стоимости поездки + <?=$one['delta_price']?>  %
			</div>
			</div>
			
		</li>
	<?php endforeach; ?>
	</ul>
	
	
<?php elseif($levels):?>
	<ul style="margin-left: 200px">
	<?php foreach($levels as $one):?>
		<li style="margin-bottom: 10px">
			<h4 style="background-color: #d9d325; width: 500px;margin-bottom: 0"><?=$one['name']?></h4>
			<div style="border: 1px solid black; width: 500px">
			<p style="width: 100%; font-size: 18px"><?=$one['discription']?></p>
			<div  style="border: 1px solid black;">
				Количество поездок для достижения: <?=$one['trips']?><br>
				Количество баллов для достижения: <?=$one['points']?>
			</div>
			</div>
			
		</li>
	<?php endforeach; ?>
	</ul>
<?php else:?>
<div>
	<form></form>
	<form method="post" action="" style="float: left;padding-right: 30px">
		<input type="submit" name="tarifs" value="Тарифы" style="width: 100px;"><br>
		<input type="submit" name="levels" value="Уровни" style="width: 100px;">
	</form>
		<div style="font-size: 20px; width: 1000px; margin-left: 200px">
			<p><b>Futucar</b> - это лучший каршеринг в России</p>
			<p>Берите машины в любой точке города и отправляйтесь в увлекательное путешествие вместе с нами</p>

			<p>Каршеринг позволяет сэкономить до 70 % совокупной стоимости транспорта для участников, так как вы оплачивете только время, когда реально используете автомобиль</p>
			<p>Наш каршеринг предоставляет большой ассортимент автомобилей, а также систему уровней. Повышая уровни вам отрываются все более мощные и элитные автомобили</p>
		</div>
	  
	  <div style="width: 1000px; margin-left: 200px"><img src="img/phone.png" style="width: 100%"></div>
</div>

<?php endif?>