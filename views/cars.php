<div >
	<?php foreach($all_car as $kind => $cars):?>
	<h4 style="background-color: #d9d325; margin-left: 20px"><?=$kind?></h4>
	<ul style="margin-left: 200px">
		<?php foreach($cars as $one_car):?>
		<li style="list-style-type: none; ">
			<p style="font-size: 20px"><?=$one_car['ncar']?></p>
			<div style="width: 300px; ">
				<img src="img/<?=$one_car['photo']?>" style="width: 100%">
			</div>
			

		</li>
		<?php endforeach;?>
	</ul>
	<?php endforeach;?>

</div>