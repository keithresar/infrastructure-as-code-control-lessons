<?php

if (array_key_exists('user',$_REQUEST) && array_key_exists('password',$_REQUEST))  {
    if (preg_match("/^student\d*$/",$_REQUEST['user']) && $_REQUEST['password']==$GLOBALS['USER_PASSWORD'])  {
        $_SESSION['user'] = $_REQUEST['user'];
        Redirect("/i/main");
        exit;
    }  else  {
        $GLOBALS['login_error'] = true;
    }
}


?>
