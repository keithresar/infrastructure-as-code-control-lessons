<?php

function Redirect($url)
{
    // clean up URL before executing it
	while (strstr($url, '&&')) $url = str_replace('&&', '&', $url);
	while (strstr($url, '&amp;&amp;')) $url = str_replace('&amp;&amp;', '&amp;', $url);

	// header locates should not have the &amp; in the address it breaks things
	while (strstr($url, '&amp;')) $url = str_replace('&amp;', '&', $url);

	header('Location: ' . $url);
	exit(0);
}


function FourZeroFour($message)
{
    header("HTTP/1.0 404 Not Found");
    Error("danger",$message);
    $_REQUEST['pn'] = "404";
}


function RequestParameters($params_keys)
{
    $params = array();

    foreach ($params_keys as $key)
        if (array_key_exists($key,$_REQUEST))
            $params[] = sprintf("%s=%s",urlencode($key),urlencode($_REQUEST[$key]));

    return(join("&",$params));
}

?>
