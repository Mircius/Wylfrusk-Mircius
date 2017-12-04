<?php
function enviarInvitacion($correo,$idUsuario,$idConsulta){
	$qstr= "INSERT INTO `Invitacion`(`ID_Usuario`, `ID_Consulta`)  VALUES ('$idUsuario','$idConsulta')";
	$query=$con->prepare($qstr);
	$query->execute();
	$e= $query->errorInfo();
	if ($e[0]!='00000') {
		die("Error accedint a dades: " . $e[2]);
	}
	$mensaje = "Estimado/a usuario nos gustaria invitarte a nuestra pagina para que puedas votar a una serie de cuestiones.";
	$mensaje = wordwrap($mensaje, 70, "\r\n");
	mail($correo, 'Invitacion Project Vota', $mensaje);
}
?>