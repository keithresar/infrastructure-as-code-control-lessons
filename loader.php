<?php


session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

/*** includes *****/
require_once("configure.php");
require_once("functions/file_loader.php");
require_once("functions/web.php");
require_once("classes/time_utils.php");

//require_once("classes/vendor/autoload.php");




$GLOBALS['min_header'] = false;
$GLOBALS['breadcrumbs'] = array();
//$GLOBALS['BODY_CLASS'] = 'navbar-fixed breadcrumbs-fixed sidebar';
//$GLOBALS['hide_breadcrumb'] = $GLOBALS['hide_sidebar'] = true;

if ($_REQUEST['pn'] == '')  $_REQUEST['pn'] = 'main';


/* If request handling file exists then load */

if (preg_match('/lessons_/',$_REQUEST['pn']))  FileLoader("process_request/",'lessons_loader');
else if (preg_match('/help_/',$_REQUEST['pn']))  FileLoader("process_request/",'help_loader');
else if (preg_match('/editor_/',$_REQUEST['pn']))  FileLoader("process_request/",'editor_loader');
else  FileLoader("process_request/",$_REQUEST['pn']);


if (!array_key_exists('user',$_SESSION) && in_array($_REQUEST['pn'],['tickets','tickets_new','terminal','editor']))  $_REQUEST['pn'] = 'login';

/*** headers *****/
print "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
print "<html>\n<head>\n";
if (!in_array($_REQUEST['pn'],explode(',','foo,bar'),true))  {
	//if (!in_array($_REQUEST['pn'],explode(',',''),true))  require_once("headers/global.php");
	require_once("headers/global.php");
    if (preg_match('/lessons_/',$_REQUEST['pn']))  FileLoader("headers/",'lessons_loader');
	else if (!FileLoader("headers/",$_REQUEST['pn']))  FileLoader("headers","undefined");
	if (array_key_exists('header_arr',$GLOBALS))  print join("\n",$GLOBALS['header_arr']);
}


print "\n</head>\n";


/*** body *****/
if (!in_array($_REQUEST['pn'],explode(',','foo,bar'),true))  {
	require_once("bodies/global.php");

    if (preg_match('/lessons_/',$_REQUEST['pn']))  FileLoader("bodies/",'lessons_loader');
    else if (preg_match('/help_/',$_REQUEST['pn']))  FileLoader("bodies/",'help_loader');
	else if (!$_REQUEST['pn'])  FileLoader("bodies","main");
	if (!FileLoader("bodies",$_REQUEST['pn']))  FileLoader("bodies","page_not_found");
}


/*** footers *****/
if (!in_array($_REQUEST['pn'],explode(',',''),true))  {
    if (preg_match('/lessons_/',$_REQUEST['pn']))  FileLoader("footers/",'lessons_loader');
    else if (preg_match('/help_/',$_REQUEST['pn']))  FileLoader("footers/",'help_loader');
	else if (!$_REQUEST['pn'])  FileLoader("footers",$_REQUEST['pn']);
	require("footers/global.php");
}


/* add js includes then inline scripts */
if (!in_array($_REQUEST['pn'],explode(',','foo,bar'),true))  {
	if (array_key_exists('SCRIPTS_ARR',$GLOBALS))  
		print "<script src='".join("'></script>\n<script src='",array_keys($GLOBALS['SCRIPTS_ARR']))."'></script>\n";
	FileLoader("scripts",'global');
    if (preg_match('/lessons_/',$_REQUEST['pn']))  FileLoader("scripts/",'lessons_loader');
	else if (!FileLoader("scripts/",$_REQUEST['pn']))  FileLoader("scripts","undefined");
}


if (!in_array($_REQUEST['pn'],explode(',','foo,bar'),true))  {
	print "</body></html>\n";
}




?>
