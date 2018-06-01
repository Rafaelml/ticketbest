<?php
require_once  '../models/UserR.php';
	$a = new UserR();
	$idUser = $a->getIdUser($_REQUEST["user"]);
	if ($idUser != null) {
		echo "existe";
	} else {
		echo "disponible";
	}
?>
