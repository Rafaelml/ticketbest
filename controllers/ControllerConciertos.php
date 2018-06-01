<?php
/**
 * Created by PhpStorm.
 * User: rmadrigal
 * Date: 16/05/18
 * Time: 13:03
 */
require_once ("Controller.php");
$controller=new Controller();
if(isset($_REQUEST["username"])){
    $name = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
    $fecha = htmlspecialchars(trim(strip_tags($_REQUEST["fecha"])));
    $idCantante = htmlspecialchars(trim(strip_tags($_REQUEST["cantante"])));
    $lugar = htmlspecialchars(trim(strip_tags($_REQUEST["lugar"])));
    $controller->createConcierto($name,$fecha,$idCantante,$lugar);
}
else{
    $controller->eliminarConcierto($_REQUEST['$concierto']);
}