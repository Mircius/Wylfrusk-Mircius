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

function enviarFormulario($consulta,$userid,$fechaInicio,$fechaFinal,$con){
	$qstr= "INSERT INTO `Consulta`(`Desc_Pregunta`, `ID_Usuario`, `F_Inicio`, `F_Final`)  VALUES ('$consulta','$userid','$fechaInicio','$fechaFinal' )";
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

		$idConsulta=enviarFormulario($_POST['consulta'],$userid,$_POST['fechaInicio'],$_POST['fechaFinal'],$con);

		enviarFormularioRespuestas($idConsulta,$_POST['respuesta'],$con);
	



			

	

}

	?>

<script>
	   var count = 1;

	function crearFormulario() { 
	   var label = document.createElement('label');
	   var textarea = document.createElement('TEXTAREA');
	   textarea.setAttribute("name", "consulta");

	   var br = document.createElement('br'); 
	   textarea.cols = 50;
	   textarea.rows = 4;
	   var labeltextnode = document.createTextNode('Escriba la pregunta:');
	   label.appendChild(labeltextnode);
	   var form = document.querySelector("form");
	   form.appendChild(label);
	   form.appendChild(br);
	   form.appendChild(textarea);
	   createFechaInicio(form);
	   createFechaFinal(form);
	   createButtonRespuesta(form,count);


	}

	function createFechaInicio(form){
		var br = document.createElement('br'); 
		var labelInicio = document.createElement('labelInicio')
		var labelTextInicio = document.createTextNode('Introduce la fecha de inicio: ');
	    var inputInicio = document.createElement('INPUT');
	   	labelInicio.appendChild(labelTextInicio);
	    inputInicio.setAttribute("type", "date");
	   	inputInicio.setAttribute("name", "fechaInicio");
	   	form.appendChild(br);
	   	form.appendChild(labelInicio);
	    form.appendChild(inputInicio);


	}

	function createFechaFinal(form){
		var br = document.createElement('br'); 
		var labelFinal = document.createElement('labelFinal')
		var labelTextFinal = document.createTextNode('Introduce la fecha final: ');
	    var inputFinal = document.createElement('INPUT');
	   	labelFinal.appendChild(labelTextFinal);
	    inputFinal.setAttribute("type", "date");
	   	inputFinal.setAttribute("name", "fechaFinal");
	   	form.appendChild(br);
	   	form.appendChild(labelFinal);
	    form.appendChild(inputFinal);
	}
	function createButtonRespuesta(form){
		var br = document.createElement('br'); 
		var button = document.createElement('BUTTON');
		var buttonText = document.createTextNode('Añadir respuesta');
		button.appendChild(buttonText);
		button.setAttribute("name","ButtonRespuesta");
		var workin = document.querySelector(".workin");
		button.setAttribute("onclick","buttonRespuesta()")
		workin.appendChild(button);
		
		

	}
	function buttonRespuesta(){
		var form = document.querySelector("form");
		var br = document.createElement('br'); 
		br.setAttribute('name','beerre');
		var labelRespuesta = document.createElement('label');
		labelRespuesta.setAttribute("for","Respuesta")
		var labeltextRespuesta = document.createTextNode('Respuesta '+count+': ');
		labelRespuesta.appendChild(labeltextRespuesta);
	    var inputRespuesta = document.createElement('input');
	   	inputRespuesta.setAttribute("type", "text");
	   	inputRespuesta.setAttribute("name", "Respuesta "+count);
	   	inputRespuesta.setAttribute("class", "RespuestaMaestra");
	   	form.appendChild(br);
	   	form.appendChild(labelRespuesta);
	   	form.appendChild(inputRespuesta);
	   	if (count==1) {
			crearBorrarRespuestas(form);
		}
		if (count==2){
			crearBotonEnviar();
		}
	   	count++;
	}

	function crearBorrarRespuestas(form){
		var br = document.createElement('br'); 
		var buttonBorrar = document.createElement('BUTTON');
		var buttonBorrarText = document.createTextNode('Borrar respuestas');
		buttonBorrar.appendChild(buttonBorrarText);
		buttonBorrar.setAttribute("name",'borrar');
		var workin = document.querySelector(".workin");
		buttonBorrar.setAttribute("onclick","BorrarRespuestas()")
		workin.appendChild(buttonBorrar);
    }
    function BorrarRespuestas(){
    	var label = document.querySelectorAll("label[for='Respuesta']");
    	var input = document.querySelectorAll("input[class='RespuestaMaestra']");
    	var br = document.querySelectorAll("br[name='beerre']");
    	var br2 = document.querySelectorAll("br[name='beerre2']");


    	for (var i = label.length - 1; i >= 0; i--) {
    		document.querySelector("form").removeChild(label[i]);
		}
		for (var i = input.length - 1; i >= 0; i--) {
			document.querySelector("form").removeChild(input[i]);
		}
		for (var i = br.length - 1; i >= 0; i--) {
			document.querySelector("form").removeChild(br[i]);
		}
		for (var i = br2.length - 1; i >= 0; i--) {
			document.querySelector(".workin").removeChild(br2[i]);
		}
		
    	count = 1;
    	BorrarButtonBorrarRespuestas();
    	BorrarButtonEnviar();
    }
    function BorrarButtonBorrarRespuestas(){
    	var button = document.querySelector("button[name='borrar']")
    	document.querySelector(".workin").removeChild(button);
    }
    function crearBotonEnviar(){
		var br = document.createElement('br'); 
		br.setAttribute('name','beerre2');
		var buttonEnviar = document.createElement('BUTTON');
		var buttonEnviarText = document.createTextNode('Enviar formulario');
		buttonEnviar.appendChild(buttonEnviarText);
		buttonEnviar.setAttribute("name",'Enviar');
		var workin = document.querySelector(".workin");
		buttonEnviar.setAttribute("value","Enviar")
		workin.appendChild(br); 
		workin.appendChild(buttonEnviar);
    }
    function BorrarButtonEnviar(){
    	var button = document.querySelector("button[name='Enviar']")
    	document.querySelector(".workin").removeChild(button);


    }
	
</script>
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
				<button name="CrearFormulario" onclick="crearFormulario()"> Crear Formulario</button>
				<form action="" method="POST" class="formu">
<!-- 			<p>Escriba la pregunta: </p>
						<textarea name="consulta" rows="4" cols="50"></textarea>

						<p>Introduce la fecha de inicio: <input type="date" name="preguntaFechaInicio"></p>
						<p>Introduce la fecha final: <input type="date" name="preguntaFechaFinal"></p>
						<br>
						<p>Respuesta: <input type="text" name="respuesta"></p>
						<br>
						<input type="submit" value="Enviar" name="Enviar"> -->

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