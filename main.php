<?php
require_once('functions.php');
$title = "Главная";
 
$page_content = renderTemplate('views/main.php',['name' => 'Олег']);
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);
?>