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
			<input type="hidden" name="form" value="login">
			<input style="" type="submit" name="login" value="Войти">

	</nav>
	
	<div style="clear: both;">
		<?=$content; ?>
	</div>

</body>
</html>