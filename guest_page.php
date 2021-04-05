<?php
require_once('functions.php');
$title = "Гостевая книга";
 
$page_content = renderTemplate('views/guest_page.php',['name' => 'Олег']);
$layout_content = renderTemplate('views/layout.php',['title' => $title,'content'=>$page_content]);
print($layout_content);
?>