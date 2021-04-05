<?php 

function renderTemplate($template, $param = false) {
    ob_start();
    if ($param) {
        extract($param);
    }

    include($template);
    $p = ob_get_contents();
    ob_end_clean();
    return $p;
    
}
?>