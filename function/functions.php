<?php 

function renderTemplate($template, $param = false) {
    ob_start();
    if ($param) {
        extract($param);
    }

    include($template);
    $p = (string) ob_get_contents();
   // ob_end_flush();//ob_clean(); //ob_end_clean
    return (string) $p;
    
}
?>