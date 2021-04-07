<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="../img/icon2.ico" type="image/x-icon">
	<?php if($title): ?>
		<title>Futucar - <?=$title; ?></title>
	<?php else:?>
		<title>Futucar</title>
	<? endif; ?>
</head>
<body>
	<header>
		
			<h1>Futucar</h1> 
		
	</form>
	</header>
	<nav>
		
		<form method="post" action="../index.php" style="float: left;">
			<input type="hidden" name="form" value="nav">
			<input type="submit" name="main" value="Главная">
			<input type="submit" name="rent" value="Аренда">
			<input type="submit" name="сars" value="Машины">
			<input type="submit" name="guest_page" value="Гостевая книга">
		</form>
		<form style="float: right;" method="post" action="../index.php">

			<?php if(isset($_SESSION['uid'])): ?>
				<input type="hidden" name="form" value="exit">
				<input style="" type="submit" name="exit" value="Выйти">
			<?php else: ?>
				<input type="hidden" name="form" value="login">
				<input style="" type="submit" name="login" value="Войти">
			<?php endif;?>
		</form>


	</nav>
	<div style="clear: both;"></div>
	<?php if($title): ?>
		<h2><?=$title; ?></h2>
	<?php else:?>
		<h2>Futucar</h2>
	<? endif; ?>
	<div>
		<?=$content; ?>
	</div>

</body>
</html>