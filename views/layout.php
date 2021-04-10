<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="../img/icon2.ico" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<?php if($title): ?>
		<title>Futucar - <?=$title; ?></title>
	<?php else:?>
		<title>Futucar</title>
	<? endif; ?>
</head>
<body><!-- #0497c4 -->
	<header style="display: block;height: 250px; background: url(img/header-bg.jpg) no-repeat 96% 88% ;">

		<div style="position: relative;top:80px;left: 100px; margin-bottom: 0px;  color: #12b046; font-family:FreeMono, monospace; ; background-color: white; width: 300px; height: 70px;display: flex; align-items:center; justify-content: center; ">
		
				<h1><button style="background: transparent;border: 0; padding: 0px;margin:0px;"><img src="img/icon2.ico"></button>
				<b>Futucar</b></h1> </div>
		
			
	</header>

	<div style="float: right;">

		<form  method="post" action="../index.php" >

			<?php if(isset($_SESSION['uid'])): ?>
				<div>
				<input type="hidden" name="form" value="user">
				<div><input style="" type="submit" name="exit" value="Выйти" ></div>
				<div><input style="" type="submit" name="profile" value="Личный кабинет" ></div>
				<div>Привет, <?=$_SESSION['name']?></div>
				</div>
			<?php else: ?>

				<input type="hidden" name="form" value="login">
				<input style="" type="submit" name="login" value="Войти" style="width: 100px;">
			<?php endif;?>
		</form>
		</div>
	<nav style="background-color: #07b03f; height: 60px; padding-top: 0px;">
	<div  style=" display: flex; align-items:flex-start; justify-content: center; ">
		<div>
		<form method="post" action="../index.php" style="float: left;">
			
				<input type="hidden" name="form" value="nav">
			<input type="submit" name="main" value="Главная" style="width: 120px;">
			<input type="submit" name="rent" value="Аренда" style="width: 120px;">
			<input type="submit" name="сars" value="Машины" style="width: 120px;">
			<input type="submit" name="guest_page" value="Гостевая книга" style="width: 120px;">
			<input type="submit" name="contacts" value="Контакты" style="width: 120px;">
		</form>
		</div>
	</div>
		
	
	</nav>
	<div style="clear: left;"></div>
	<?php if($title): ?>
		<h2><?=$title; ?></h2>
	<?php else:?>
		<h2>Futucar</h2>
	<? endif; ?>
	<div>
		<?=$content; ?>
	</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>