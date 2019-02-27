<?php

if (array_key_exists('user',$_SESSION))  unset($_SESSION['user']);
Redirect("/");
exit;

?>
