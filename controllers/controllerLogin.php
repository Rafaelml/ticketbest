<?php
    require_once ("Controller.php");
    $nick = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
	$password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));
	$controller=new Controller();
    $controller->login($nick,$password);
?>