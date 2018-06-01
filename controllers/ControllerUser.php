<?php
/**
 * Created by PhpStorm.
 * User: rmadrigal
 * Date: 16/05/18
 * Time: 14:42
 */
require_once ("Controller.php");
$controller=new Controller();
if(!isset($_SESSION)){
    session_start();
}
if(isset($_REQUEST['$userdel'])){
    $name = htmlspecialchars(trim(strip_tags($_REQUEST['$userdel'])));
    $controller->delUser($name);
}