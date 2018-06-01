<?php
    require_once ("Controller.php");
    $controller=new Controller();
	session_start();

	if(isset($_POST['follow'])){
		$controller->actFollowing($_SESSION['idUser'],41);
        $_SESSION['pulsado'] = true;
	}else{
		$_SESSION['pulsado'] = false;
	}

	header('Location: ../views/index2.php');
	
?>