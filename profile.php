<?php 
session_start();
require_once('functions.php');



	$title = "Личный кабинет";

	

	$page_content = renderTemplate('views/profile.php',['error_list' => $error_list,'display_window'=>$_SESSION['new_acc']]); 
	$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
	print($layout_content);

?>