<?php 
session_start();

if($_POST['form']=="nav")
{
	if($_POST['main'])
		header("Location: http://futucar/main.php");
	elseif($_POST['rent'])
	{
		if(isset($_SESSION['uid']))
			header("Location: http://futucar/rent.php");
		else
		{
			$_SESSION['dont_access'] = true;
			header("Location: http://futucar/login.php");
		}

	}
	elseif($_POST['сars'])
		header("Location: http://futucar/cars.php");
	elseif($_POST['guest_page'])
		header("Location: http://futucar/guest_page.php");
	elseif($_POST['contacts'])
		header("Location: http://futucar/contacts.php");
	

}
elseif($_POST['form'] == "login")
{
	header("Location: http://futucar/login.php");
}
elseif($_POST['form'] == "user")
{
	if($_POST['exit'])
	{
		session_unset(); //unset($_SESSION['uid'])
		header("Location: http://futucar/main.php");
	}
	elseif($_POST['profile'])
		header("Location: http://futucar/profile.php");

	

}
else
{
	header("Location: http://futucar/main.php");
}





?>