<!-- Nom del fitxer: consultas.php
Data de creació: 23/11/2017
Nom del creador: Sergi Coma
Descripció de la funcionalitat: -->

<!DOCTYPE html>
<html>
<head>
	<title>Main</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<!-- 
Nom del fitxer:
Data de creació:
Nom del creador:
Descripció de la funcionalitat:

Descripció de la funció:
[Parametres d'entrada]:
[Valor de retorn]:
[Afegir comentaris a pasos complexos].
	-->
	<style>
		html, body{
			font-family: 'Roboto Condensed', sans-serif;
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
			height: auto;
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
			padding-top: 0.5em;
			padding-bottom: 0.5em;
			margin-left:30px;
			margin-right:30px;
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
		.boxShadowParaVacioRojo{
			box-shadow: 0 0 5px red;
		}
		.logo{
			display:block;
			margin-left:auto;
			margin-right:auto;
			margin:10px;
		}
		.logo img{
			display:block;
			margin-left:auto;
			margin-right:auto;
			width: 150px;
			height: auto;
			position:relative;
			animation: slide_in 5s ease-in-out infinite;
		}
		@keyframes slide_in {
			0%{opacity:0.1;}
			50%{opacity:1;}
			100%{opacity:0.1;}
		  }

		.banner{
			display:block;
			margin-left: auto;
			margin-right:auto;
		}
		.banner img{
			display:block;
			margin-left: auto;
			margin-right:auto;
			width: auto;
			height:200px;
		}
	</style>
</head>
<body>
	<?php
		session_start();
		include_once ("conexion.php");
		$userid = $_SESSION['userid'];

function enviarFormulario($consulta,$userid,$fechaInicio,$fechaFinal,$fechaInicioHora,$fechaFinalHora,$con){
	$qstr= "INSERT INTO `Consulta`(`Desc_Pregunta`, `ID_Usuario`, `F_Inicio`, `F_Final`,`H_Inicio`,`H_Final`)  VALUES ('$consulta','$userid','$fechaInicio','$fechaFinal','$fechaInicioHora','$fechaFinalHora')";
	$query=$con->prepare($qstr);
	$query->execute();
	$e= $query->errorInfo();
	$idConsulta = $con->lastInsertId();
	if ($e[0]!='00000') {
		die("Error accedint a dades: " . $e[2]);
	}
	return $idConsulta;
}
function enviarFormularioRespuestas($idConsulta,$arrayRespuestas,$con){
	for ($i=0; $i <sizeof($arrayRespuestas) ; $i++) { 
		$qstr= "INSERT INTO `Opcion`(`ID_Consulta`, `Descripcion`) VALUES ('$idConsulta','".$arrayRespuestas[$i]."')";
		$query=$con->prepare($qstr);
		$query->execute();
		$e= $query->errorInfo();
		if ($e[0]!='00000') {
			die("Error accedint a dades: " . $e[2]);
		}
	}
}
function cojerRespuesta($lista){
	$listaRespuestas = array();
	foreach($lista as $llave =>$valor){
		if (strpos($llave,'Respuesta')!== false){
			$listaRespuestas[] = $valor;
		}
	}
	return ($listaRespuestas);
}


if(isset($_POST['Enviar'])){
		$idConsulta=enviarFormulario($_POST['consulta'],$userid,$_POST['fechaInicio'],$_POST['fechaFinal'],$_POST['fechaInicioHora'],$_POST['fechaFinalHora'],$con);
		$listaRespuestas = cojerRespuesta($_POST);
		enviarFormularioRespuestas($idConsulta,$listaRespuestas,$con);
	

			

	

}

	?>
<script>
	   var count = 1;
	   var crea = false;


// Descripció de la funció: Permite crear el formulario del cual con otras funciones iremos añadiendo todos los inputs y botones.
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
	   crearFechaInicio(form);
	   crearFechaFinal(form);
	   crearBotonRespuesta(form,count);
	   borrarCrearFormulario();
	   onChanged();
	   required();

	}
	// Descripció de la funció: Permite crear el boton para borrar una respuesta individualmente.
	// [Parametres d'entrada]: El elemento div que engloba el input de la respuesta.
	function crearBotonBorrarUnaRespuesta(div){
		var br = document.createElement('br');
		var button = document.createElement('BUTTON');
		var buttonText = document.createTextNode('Borrar esta respuesta');
		button.appendChild(buttonText);
		button.setAttribute("name","BorrarUnaRespuesta");
		button.setAttribute("onclick","botonBorrarUnaRespuesta(event)")
		div.appendChild(button);


	}
	// Descripció de la funció: Añade la logica para eliminar una respuesta individualmente.
	// [Parametres d'entrada]: El evento onclick.

	function botonBorrarUnaRespuesta(event){
		event.currentTarget.parentNode.remove();
		var div = document.querySelectorAll("div[name='divaso']");

		for (var i =0; i<div.length;i++){

		var label = div[i].children[0];		
		i++;
		label.innerHTML = "Respuesta "+ i +": ";
		i--;
		
		}
		count = div.length+1;
		if (count == 1){
			BorrarButtonBorrarRespuestas();
			borrarButtonEnviar();
			crea = false;

		}

	}
	// Descripció de la funció: Permite crear el boton que mueve hacia arriba la respuesta elegida.
	// [Parametres d'entrada]: El elemento div que engloba el input de la respuesta.

	function crearBotonSubirRespuesta(div){
		var button = document.createElement('BUTTON');
		var buttonText = document.createTextNode('Subir');
		button.appendChild(buttonText);
		button.setAttribute("name", "SubirRespuesta");
		button.setAttribute("type","button");
		button.setAttribute("onclick","botonSubirRespuesta(event)");
		div.appendChild(button);
	}
	// Descripció de la funció: Añade la logica para mover hacia arriba la respuesta elegida.
	// [Parametres d'entrada]: El evento onclick.

	function botonSubirRespuesta(event){
		var form = document.querySelector("form");
		var divs = event.currentTarget.parentNode
		var divsClone = event.currentTarget.parentNode.cloneNode(true);
		var anterior = divs.previousSibling;
		
		if (anterior.tagName=="DIV"){
			event.currentTarget.parentNode.remove();
			form.insertBefore(divsClone,anterior);
			var div = document.querySelectorAll("div[name='divaso']");

			for (var i =0; i<div.length;i++){

				var label = div[i].children[0];		
				i++;
				label.innerHTML = "Respuesta "+ i +": ";
				i--;

			}
		
		}

	}
	// Descripció de la funció: Permite crear el boton para bajar una respuesta.
	// [Parametres d'entrada]: El elemento div que engloba el input de la respuesta.

	function crearBotonBajarRespuesta(div){
		var button = document.createElement('BUTTON');
		var buttonText = document.createTextNode('Bajar');
		button.appendChild(buttonText);
		button.setAttribute("name", "BajarRespuesta");
		button.setAttribute("type","button");
		button.setAttribute("onclick","botonBajarRespuesta(event)");
		div.appendChild(button);
	}
	// Descripció de la funció: Añade la logica para bajar una respuesta.
	// [Parametres d'entrada]: El evento onclick.
	function botonBajarRespuesta(event){
		var form = document.querySelector("form");
		var divs = event.currentTarget.parentNode
		var divsClone = event.currentTarget.parentNode.cloneNode(true);
		var siguiente = divs.nextSibling;
		if (siguiente.tagName=="DIV"){
			event.currentTarget.parentNode.remove();
			insertAfter(divsClone,siguiente);
			var div = document.querySelectorAll("div[name='divaso']");

			for (var i =0; i<div.length;i++){

				var label = div[i].children[0];		
				i++;
				label.innerHTML = "Respuesta "+ i +": ";
				i--;

			}
		
		}

	}
	function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
	// Descripció de la funció: Permite crear la fecha inicio y la hora inicio del formulario.
	// [Parametres d'entrada]: Es el elemento form.

	function crearFechaInicio(form){
		var br = document.createElement('br'); 
		var labelInicio = document.createElement('labelInicio')
		var labelTextInicio = document.createTextNode('Introduce la fecha de inicio: ');
	    var inputInicio = document.createElement('INPUT');
	    var inputInicioHora = document.createElement('INPUT');
	    inputInicioHora.setAttribute("type","time");
	    inputInicioHora.setAttribute("name","fechaInicioHora");
	    inputInicioHora.setAttribute("value","00:00");
	   	inputInicioHora.setAttribute("step","900");
	   	labelInicio.appendChild(labelTextInicio);
	    inputInicio.setAttribute("type", "date");
	   	inputInicio.setAttribute("name", "fechaInicio");
	   	form.appendChild(br);
	   	form.appendChild(labelInicio);
	    form.appendChild(inputInicio);
	    form.appendChild(inputInicioHora);
	}
	// Descripció de la funció: Permite crear la fecha final y la hora final del formulario.
	// [Parametres d'entrada]: Es el elemento form.


	function crearFechaFinal(form){
		var br = document.createElement('br'); 
		var labelFinal = document.createElement('labelFinal')
		var labelTextFinal = document.createTextNode('Introduce la fecha final: ');
	    var inputFinal = document.createElement('INPUT');
	    var inputFinalHora = document.createElement('INPUT');
	    inputFinalHora.setAttribute("type","time");
	    inputFinalHora.setAttribute("name","fechaFinalHora");
	   	inputFinalHora.setAttribute("value","00:00");
	   	inputFinalHora.setAttribute("step","900");
	   	labelFinal.appendChild(labelTextFinal);
	    inputFinal.setAttribute("type", "date");
	   	inputFinal.setAttribute("name", "fechaFinal");
	   	form.appendChild(br);
	   	form.appendChild(labelFinal);
	    form.appendChild(inputFinal);
	    form.appendChild(inputFinalHora);

	}
	// Descripció de la funció: Permite crear el boton para añadir una respuesta.
	// [Parametres d'entrada]: Es el elemento form.

	function crearBotonRespuesta(form){
		var br = document.createElement('br'); 
		var button = document.createElement('BUTTON');
		var buttonText = document.createTextNode('Añadir respuesta');
		button.appendChild(buttonText);
		button.setAttribute("name","ButtonRespuesta");
		var workin = document.querySelector(".workin");
		button.setAttribute("onclick","buttonRespuesta()")
		workin.appendChild(button);
		
		
	}
	// Descripció de la funció: Añade la logica para añadir el boton de crear respuesta.

	function buttonRespuesta(){
		var div = document.createElement("div");
		div.setAttribute("name","divaso");
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
	   	form.appendChild(div);
	   	div.appendChild(labelRespuesta);
	   	div.appendChild(inputRespuesta);
	   	crearBotonSubirRespuesta(div);
	   	crearBotonBajarRespuesta(div);
	   	crearBotonBorrarUnaRespuesta(div);
	   	if (count==1) {
			crearBorrarRespuestas(form);
		}
		if (count>=2){
			if(crea==true){
				borrarButtonEnviar();

			}
			crearBotonEnviar();
			crea = true;
		}
	   	count++;
	   	onChanged();
		required();
	}
	// Descripció de la funció: Permite crear el boton para borrar todas las respuestas.
	// [Parametres d'entrada]: Es el elemento form.
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
    // Descripció de la funció: Añade la logica para eliminar todas las respuestas.

    function BorrarRespuestas(){
    	var div = document.querySelectorAll("div[name='divaso']");
    	for (var i = div.length - 1; i >= 0; i--) {
    		document.querySelector("form").removeChild(div[i]);
    	}
    	count = 1;
    	BorrarButtonBorrarRespuestas();
    	borrarButtonEnviar();
    	crea = false;
    }

    // Descripció de la funció: Añade una logica que permite eliminar el boton de borrar respuestas si la situacion lo requiere.
    function BorrarButtonBorrarRespuestas(){
    	var button = document.querySelector("button[name='borrar']");
    	document.querySelector(".workin").removeChild(button);
    }

    // Descripció de la funció: Permite crear el boton que nos permitira enviar los datos del formulario.
    function crearBotonEnviar(){
		var br = document.createElement('br'); 
		br.setAttribute('name','beerre2');
		var buttonEnviar = document.createElement('INPUT');
		buttonEnviar.setAttribute("type",'submit');
		buttonEnviar.setAttribute("name",'Enviar');
		var form = document.querySelector("form");
		buttonEnviar.setAttribute("value","Enviar")
		form.appendChild(br); 
		form.appendChild(buttonEnviar);
    }

    // Descripció de la funció: Esta funcion nos permite, si la situacion lo requiere, borrar el boton enviar.
    function borrarButtonEnviar(){
    	var button = document.querySelector("input[name='Enviar']")
    	document.querySelector("form").removeChild(button);
   		var br2 = document.querySelectorAll("br[name='beerre2']");
   		for (var i = br2.length - 1; i >= 0; i--) {
			document.querySelector("form").removeChild(br2[i]);
		}

    }
 	// Descripció de la funció: Una vez el formulario de ha creado el boton se elimina para evitar problemas.

    function borrarCrearFormulario(){
    	var button = document.querySelector("button[name='CrearFormulario']")
    	document.querySelector(".workin").removeChild(button);

    }

    // Descripció de la funció: Llama a una funcion para habilitar o deshabilitar el boton enviar segun el contenido de los inputs.
    function interruptorVacioRojo(){
		var botonEnviar = document.querySelector('body > section.container > div > div > form > input[type="submit"]');
		var interruptorEnviar = document.querySelectorAll('.boxShadowParaVacioRojo');
		if (typeof interruptorEnviar !== 'undefined'){
			if (interruptorEnviar.length > 0){
				botonDisableEnable(true);
			}else{
				botonDisableEnable(false);
			}
		}
	}
	// Descripció de la funció: Esta funcion se utiliza multiples veces. Habilita o deshabilita el boton enviar.
	// [Parametres d'entrada]: Boolean para habilitar o deshabilitar.

	function botonDisableEnable(e){
		var botonEnviar = document.querySelector('body > section.container > div > div > form > input[type="submit"]');
		console.log(e);
		if (e==true){
			botonEnviar.disabled = true;
		}else{
			botonEnviar.disabled = false;
		}
	}
	// Descripció de la funció: Gestiona que los inputs sean requeridos en el formulario.

	function required(){
			var inputsYCompania = document.querySelectorAll('form > input');
			for (var i = 0; i < inputsYCompania.length; i++) {
			inputsYCompania[i].setAttribute("required","true");
			}
			document.querySelector('form > textarea').setAttribute("required","true");
			var inputsFecha = document.querySelectorAll('form > input[type=date]');
			for (var i = 0; i < inputsFecha.length; i++) {
				inputsFecha[i].onchange = function(){
					var fechaUno = document.querySelector('body > section.container > div > div > form > input[type="date"]:nth-child(6)');
					var fechaDos = document.querySelector('body > section.container > div > div > form > input[type="date"]:nth-child(10)');
					if (fechaUno.value !== "" && fechaDos.value !== ""){
						fecha();
					}

				};
			}
	}
	// Descripció de la funció: Cada vez que cambia el contenido de un input se aplica un onblur para llamar a la funcion "interruptorVacioRojo". Se aplica o se elimina la clase boxShadowParaVacioRojo.

	function onChanged(){
		var childs = document.querySelector("form").children;
		for (var i = 0; i < childs.length; i++) {
			childs[i].onblur= "";
		}
		for (var i = 0; i < childs.length; i++) {
			childs[i].onblur= function(event){
				if (event.target.value==""){
					//dar clase
					event.target.classList.add('boxShadowParaVacioRojo');
					interruptorVacioRojo();
				}
				else{
					//quitar clase
					event.target.classList.remove('boxShadowParaVacioRojo');
					interruptorVacioRojo();
				}
			}
		}
	}
	// Descripció de la funció: Esta funcion sse utiliza para validar todas las fechas segun los requisitos del proyecto.

	function fecha(){
		var interruptor = true;
		var hoy = new Date();
		var day = hoy.getDate();
        var month = hoy.getMonth() + 1;
        var year = hoy.getFullYear();
        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var fechaHoy = year + "-" + month + "-" + day;
		var fechaInicio = document.querySelector('body > section.container > div > div > form > input[type="date"]:nth-child(6)').value;
		fechaInicio = fechaInicio.split("-");
		var fechaFinal = document.querySelector('body > section.container > div > div > form > input[type="date"]:nth-child(10)').value;
		fechaFinal = fechaFinal.split("-");
		var fechaInicioMasUno = new Date(fechaInicio[0],parseInt(fechaInicio[1])-1,parseInt(fechaInicio[2])+1);
		var day2 = fechaInicioMasUno.getDate();
        var month2 = fechaInicioMasUno.getMonth() +1 ;
        var year2 = fechaInicioMasUno.getFullYear();
        if (month2 < 10) month2 = "0" + month2;
        if (day2 < 10) day2 = "0" + day2;
        var fechaInicioMasUno = year2 + "-" + month2 + "-" + day2;
		//var diaajuste= parseInt(fechaInicioMasUno[2]);
		//diaajuste = diaajuste +1;
		//fechaInicioMasUno[2]= diaajuste.toString();

		var fechaInicioHora = document.querySelector("input[name='fechaInicioHora']").value;
		fechaInicioHora = fechaInicioHora.split(":");
		var fechaFinalHora = document.querySelector("input[name='fechaFinalHora']").value;
		fechaFinalHora = fechaFinalHora.split(":");
		fechaInicioHora[0] = parseInt(fechaInicioHora[0]);
		fechaInicioHora[1] = parseInt(fechaInicioHora[1]);
		fechaFinalHora[0] = parseInt(fechaFinalHora[0]);
		fechaFinalHora[1] = parseInt(fechaFinalHora[1]);


		fechaInicio = fechaInicio[0] + "-" + fechaInicio[1] + "-" + fechaInicio[2];
		fechaFinal = fechaFinal[0] + "-" + fechaFinal[1] + "-" + fechaFinal[2];
		var triggerHoras = false;
		   if (fechaInicio <= fechaHoy){
				alert("La fecha de inicio no puede ser anterior a hoy");
		   }
		   if (fechaFinal < fechaHoy){
				alert("La fecha final no puede ser anterior a hoy");
		   }
		   if(fechaInicio == fechaFinal){
		   	 if (fechaInicioHora[0]+4 > fechaFinalHora[0]){
	   		   		alert("Tiene que haber un minimo de cuatro horas de diferencia")
	   		   		triggerHoras = true;
	   		   }
		   }
		   if (fechaInicio > fechaFinal){
				alert("La fecha final tiene que ser posterior a la fecha inicio");
		   }
		  
		 //   //if(fechaInicio <= fechaHoy && fechaInicio > fechaFinal && fechaInicioHora[0]+4 > fechaFinalHora[0])
		 //   	if (fechaInicio < fechaHoy && fechaFinal < fechaHoy && fechaInicio > fechaFinal){
			// 	botonDisableEnable(true);
			// 	console.log("Jamon");
			// }else{
			// 	botonDisableEnable(false);
			// 	console.log("JamonFalse");
			// }
		}
</script>
<div class="logo">
		<img src="img/projectvota-01-01.png">
	</div>
	<section class="navbar">
		<div class="navbar-container">
			<div class="navbar-option">
				<a href="home.php"><i class="fa fa-home"></i>  Home</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href="lista-preguntas.php"><i class="fa fa-folder-open"></i>  Lista preguntas</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href="consultas.php"><i class="fa fa-plus-square-o"></i>  Crear pregunta</a>
			</div>
			
			<div class="navbar-option-dos">
				<a href="logout.php"><i class="fa fa-window-close"></i>   Log out</a>
			</div>
			<div class="headerDivider-dos"></div>
			<div class="navbar-option-dos">
				<a><i class="fa fa-hand-spock-o"></i> <?php 
				if (isset($_SESSION['user'])){
					$userid = $_SESSION['userid'];
					$userIsAdmin = $_SESSION['admin'];
					echo "<span id='$userid' name='usuario' admin='$userIsAdmin'>".$_SESSION['user']."</span>";
				};
				?></a>
			</div>

		</div>
	</section>
	<section class="container">
		<div class="main-container">
			<div class="workin">
				<button name="CrearFormulario" onclick="crearFormulario()"> Crear Formulario</button>
				<form action="consultas.php" method="POST" class="formu">
				</form>
			</div>
		</div>
	</section>
	<section class="footer">
		<div class="footer-container">
			<div class="banner">
				<img src="img/projectvota3-01.png">
			</div>
		</div>
	</section>
</body>
</html>