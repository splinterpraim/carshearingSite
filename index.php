<?php 

if($_POST['form']=="nav")
{
	if($_POST['main'])
		header("Location: http://futucar/main.php");
	elseif($_POST['rent'])
		header("Location: http://futucar/rent.php");
	elseif($_POST['сars'])
		header("Location: http://futucar/cars.php");
	elseif($_POST['guest_page'])
		header("Location: http://futucar/guest_page.php");
	

}
elseif($_POST['form'] == "login")
{
	header("Location: http://futucar/login.php");
}
else
{
	header("Location: http://futucar/main.php");
}
echo "далеко зашел";

/*
require_once('functions.php');


$title = "";



if($_POST['main'])
{	
	header("Location: http://futucar/main.php");
	$title = 'Главная';
	$page_content = renderTemplate('main.php', ['name' => 'r']);
}
elseif($_POST['rent'])
{
	$title = 'Главная';
	$page_content = renderTemplate('main.php', ['name' => 'r']);
}




$layout_content = renderTemplate('layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);
print($_POST['main']);
var_dump($_REQUEST);

*/

?>