<!DOCTYPE html>
<html>
<head>
	<title>Main</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		html, body{
			font-family: 'Barlow Semi Condensed', sans-serif;
			height: 100%;
		}
		.navbar-container{
			width: 90%;
			height: 3em;
			margin-left: auto;
			margin-right: auto;
			display: block;
			background-color: rgba(250,250,250,0.9);
  			box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
  			border-radius: 0.5em;
		}
		.main-container{
			margin-top: 20px;
			width: 90%;
			height: 28em;
			background-color: white(200,200,200,0.9);
			margin-right: auto;
			margin-left: auto;
			display: block;
  			box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
  			border-radius: 0.5em;
		}
		.footer-container{
			margin-top: 20px;
			width: 90%;
			height: 3em;
			margin-left: auto;
			margin-right: auto;
			display: block;
			background-color: rgba(250,250,250,0.9);
  			box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
  			border-radius: 0.5em;
		}
		.navbar-option{
			margin-top: 6px;
			float: left;
			padding: 0.5em;
		}
		.navbar-option a{
			text-decoration: none;
			color: rgba(50,50,50,0.9);
		}
		.headerDivider {
			margin-top: 4px;
			float:left;
			border-right: 1px solid rgba(170,170,170,0.9);
			height: 2.5em;
		}
	</style>
</head>
<body>
	<?php
function enviarFormulario($consulta,$id_user,$preguntaFechaInicio,$preguntaFechaFinal,$con){
	$qstr= "INSERT INTO `Consulta`(`Descripcion Pregunta`, `ID_Usuario`, `Fecha Inicio`, `Fecha Final`)  VALUES ('$consulta','$id_user','$preguntaFechaInicio','$preguntaFechaFinal' )"
	$sql=$con->prepare($qstr);
	$sql->execute();
	$e= $sql->errorInfo();
	if ($e[0]!='00000') {
		die("Error accedint a dades: " . $e[2]);
	}
}












	?>
	<section class="navbar">
		<div class="navbar-container">
			<div class="navbar-option">
				<a href=""><i class="fa fa-user"></i>  Home</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href=""><i class="fa fa-user"></i>  Pregunta</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href=""><i class="fa fa-user"></i>  Huevasohueavsoisbdfnsdf</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href=""><i class="fa fa-user"></i>  Usuario</a>
				
			</div>
		</div>
	</section>
	<section class="container">
		<div class="main-container">
			<div class="workin">
				<form action="" method="POST" class="formu">

					<p>Escriba la pregunta: </p>
						<textarea name="consulta" rows="4" cols="50"></textarea>

						<p>Introduce la fecha de inicio: <input type="date" name="preguntaFechaInicio"></p>
						<p>Introduce la fecha final: <input type="date" name="preguntaFechaFinal"></p>
						<br>
						<p>Respuesta: <input type="text" name="respuesta"><input type="submit" value="Agregar respuesta"></p>

						<input type="submit" value="Enviar">
				</form>
			</div>
		</div>
	</section>
	<section class="footer">
		<div class="footer-container">
		</div>
	</section>
</body>
</html>