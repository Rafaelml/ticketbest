<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 15/5/18
 * Time: 15:28
 */
require_once ("Controller.php");
$controller=new Controller();
if(isset($_REQUEST["username"])){
$name = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
$controller->createCantante($name);
}
else{
    $controller->eliminarCantante($_REQUEST['$cantante']);
}