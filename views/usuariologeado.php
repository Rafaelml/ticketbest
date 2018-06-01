<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css" />
	<meta charset="utf-8">
	<title>Portada</title>
</head>

<body>

<div id="contenedor">

	<?php 
		require("cabecera.php"); 
		require("sidebarIzq.php"); 
	?>

	<div id="contenido">
		<?php
			if (!isset($_SESSION["login"])) {  //Usuario incorrecto
				echo "<h1>ERROR</h1>";
				echo "<p>El usuario o contraseña no son válidos.</p>";
			}
			else {  //Usuario registrado
				//echo "<h1>Bienvenido " . $_SESSION['nombre'] . "</h1>";
				echo "<h1>Bienvenido {$_SESSION['nombre']}</h1>";
				echo "<p>Usa el menú de la izquierda para navegar.</p>";
			}
		?>
	</div>

	<?php 
		include("sidebarDer.php"); 
		include("pie.php"); 
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>