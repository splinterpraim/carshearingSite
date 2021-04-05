<?php
require_once('functions.php');
$title = "Аренда";
 
$page_content = renderTemplate('views/rent.php',['name' => 'Олег']);
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);
?>