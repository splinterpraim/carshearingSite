<?php 

function renderTemplate($template, $param = false) {
    ob_start();
    if ($param) {
        extract($param);
    }
    include($template);
    $p = (string) ob_get_contents();

    ob_clean();
    return (string) $p;
    
}

function check($str, $name_str) {
	global $ERROR_LIST;
	global $ERROR_STYLE;
	global $bad_field;

	if(!ctype_digit($str) and $str!='')
	{
		$bad_field[$name_str]=$ERROR_STYLE;
		if (count($ERROR_LIST)<1) 
			array_push($ERROR_LIST, "Вы можете вводить только цифры в эти поля");
	}
}
?>