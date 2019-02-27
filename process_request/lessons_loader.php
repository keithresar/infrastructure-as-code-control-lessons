<?php

require_once("classes/Parsedown.php");

$filename = preg_replace("/^lessons_/","",preg_replace("[^a-z0-9]","_",strtolower($_REQUEST['pn'])));

if (!file_exists(sprintf("lessons/%s.md",$filename)))  {
    Redirect("/i/lessons");
    exit;
}

// TODO extract the title so we can use it in our headers

$GLOBALS['md_raw'] = file_get_contents(sprintf("lessons/%s.md",$filename));


?>
