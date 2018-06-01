<?php
    require_once ("Controller.php");
    $nick = htmlspecialchars(trim(strip_tags($_REQUEST['nick'])));
    $name = htmlspecialchars(trim(strip_tags($_REQUEST['name'])));
	$password = htmlspecialchars(trim(strip_tags($_REQUEST['pass'])));
	$repassword = htmlspecialchars(trim(strip_tags($_REQUEST['repass'])));
	$email = htmlspecialchars(trim(strip_tags($_REQUEST['email'])));
	$telefono = htmlspecialchars(trim(strip_tags($_REQUEST['tel'])));
	$lenpass = strlen($password);

	if(empty($nick) || empty($password) || empty($repassword) || empty($email)){
		echo 'Su usuario es incorrecto, intentelo de nuevo';
		exit();
	}

	if($password != $repassword){
		echo 'La contraseña no coincide. Vuelva a intentarlo.';
		exit();
	}
	else{
		if($lenpass < 4 || $lenpass > 20){
			echo 'La longitud de la contraseña es inadecuada. Vuelva a intentarlo.';
			exit();
		}

	    $controller=new Controller();
	    $usuario_data = array('idUser'=>'','nick'=>$nick, 'name'=>$name, 'password'=>$password, 'repass'=>$repassword, 'email'=>$email, 'telefono'=>$telefono);
	    $controller->registr($usuario_data);
	}
?>