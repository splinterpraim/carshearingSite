<?php
require_once('functions.php');
	$title = "Контакты";



	$page_content = renderTemplate('views/contacts.php',['error_list' => $error_list]); 
	$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>(string)$page_content]);
	print($layout_content);
?>