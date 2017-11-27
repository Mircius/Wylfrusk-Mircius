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
		.navbar-option-dos{
			margin-top: 6px;
			float: right;
			padding: 0.5em;
		}
		.navbar-option a{
			text-decoration: none;
			color: rgba(50,50,50,0.9);
		}
		.navbar-option-dos a{
			text-decoration: none;
			color: rgba(50,50,50,0.9);
		}
		.headerDivider {
			margin-top: 4px;
			float:left;
			border-right: 1px solid rgba(170,170,170,0.9);
			height: 2.5em;
		}
		.headerDivider-dos {
			margin-top: 4px;
			float:right;
			border-right: 1px solid rgba(170,170,170,0.9);
			height: 2.5em;
		}
	</style>
</head>
<body>
	<?php
		session_start();
		include_once ("conexion.php");
		$userid = $_SESSION['userid'];

function enviarFormulario($consulta,$userid,$preguntaFechaInicio,$preguntaFechaFinal,$con){
	$qstr= "INSERT INTO `Consulta`(`Desc_Pregunta`, `ID_Usuario`, `F_Inicio`, `F_Final`)  VALUES ('$consulta','$userid','$preguntaFechaInicio','$preguntaFechaFinal' )";
	$query=$con->prepare($qstr);
	$query->execute();
	$e= $query->errorInfo();
	$idConsulta = $con->lastInsertId();
	if ($e[0]!='00000') {
		die("Error accedint a dades: " . $e[2]);
	}
	return $idConsulta;
}
function enviarFormularioRespuestas($idConsulta,$respuesta,$con){
	$qstr= "INSERT INTO `Opcion`(`ID_Consulta`, `Descripcion`) VALUES ('$idConsulta','$respuesta')";
	$query=$con->prepare($qstr);
	$query->execute();
	$e= $query->errorInfo();
	if ($e[0]!='00000') {
		die("Error accedint a dades: " . $e[2]);
	}
	return $idConsulta;

}


if(isset($_POST['Enviar'])){

		$idConsulta=enviarFormulario($_POST['consulta'],$userid,$_POST['preguntaFechaInicio'],$_POST['preguntaFechaFinal'],$con);

		enviarFormularioRespuestas($idConsulta,$_POST['respuesta'],$con);
	



			

	

}

	?>
	<section class="navbar">
		<div class="navbar-container">
			<div class="navbar-option">
				<a href=""><i class="fa fa-home"></i>  Home</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href=""><i class="fa fa-plus-square-o"></i>  Crear pregunta</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href=""><i class="fa fa-folder-open"></i>  Lista preguntas</a>
			</div>
			
			<div class="navbar-option-dos">
				<a href="logout.php"><i class="fa fa-window-close"></i>   Log out</a>
			</div>
			<div class="headerDivider-dos"></div>
			<div class="navbar-option-dos">
				<a href=""><i class="fa fa-hand-spock-o"></i> <?php 
				if (isset($_SESSION['user'])){
					echo $_SESSION['user'];
				}; ?></a>
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
						<p>Respuesta: <input type="text" name="respuesta"></p>
						<br>
						<input type="submit" value="Enviar" name="Enviar">
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