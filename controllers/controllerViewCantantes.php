<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 15/5/18
 * Time: 20:33
 */
require_once ("Controller.php");
$controller=new Controller();
if(!isset($_SESSION)){
    session_start();
}
if(isset($_REQUEST['$cantante'])){
    $name = htmlspecialchars(trim(strip_tags($_REQUEST['$cantante'])));
    $controller->actFollowing($_SESSION['idUser'],$name);
}