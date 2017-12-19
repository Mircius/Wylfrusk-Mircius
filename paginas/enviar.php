<!-- Nom del fitxer: enviar.php
Data de creació: 28/11/2017
Nom del creador: Jose Gonzalez
Descripció de la funcionalitat: Este codigo permite enviar el mail y crear un usuario vacio para enlazar el link con el registro. -->
<?php
session_start();
include_once ("conexion.php");

$correo = $_POST['correo'];
$consultaid = $_POST['idconsulta'];

$qstr= "SELECT * FROM `Usuario` WHERE `Email` = '$correo'";
$query=$con->prepare($qstr);
$query->execute();
$row = $query->fetch();
if ($row) {
	$userid = $row['ID_Usuario'];
	echo 'primera opcion';
	echo $userid;
}else{
	$qstr2= "INSERT INTO `Usuario` (`Nombre`,`Apellido`,`Usuario`,`Contrasena`,`Email`,`Administrador`) VALUES ( NULL , NULL , NULL , NULL , '$correo','0')";
	$query2=$con->prepare($qstr2);
	$query2->execute();
	$e= $query2->errorInfo();
	if ($e[0]!='00000') {
		die("Error accedint a dades: " . $e[2]);
	}
	$userid = $con->lastInsertId();
	echo 'segunda opcion';
	echo $userid;
}

$qstr= "INSERT INTO `Invitacion`(`ID_Usuario`, `ID_Consulta`,`Email`) VALUES ('$userid','$consultaid','$correo')";
$query=$con->prepare($qstr);
$query->execute();
$e= $query->errorInfo();
if ($e[0]!='00000') {
	die("Error accedint a dades: " . $e[2]);
}

$mensaje = "Estimado/a usuario nos gustaria invitarte a nuestra pagina para que puedas votar a una serie de cuestiones.";
$mensaje = wordwrap($mensaje, 70, "\r\n");
mail($correo, 'Invitacion Project Vota', $mensaje);
header('location: lista-preguntas.php')
?>