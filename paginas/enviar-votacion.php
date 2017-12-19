<!-- Nom del fitxer: enviar-votacion.php
Data de creació: 28/11/2017
Nom del creador: Jose Gonzalez
Descripció de la funcionalitat: Este codigo permite insertar las votaciones en la BBDD. -->

<?php
session_start();
include_once('conexion.php');
$password = $_POST['password'];
$check = $_POST['check'];
$usuario = $_SESSION['userid'];
$idconsulta = $_POST['idconsulta'];
//$qstr= "INSERT INTO `Votaciones`(`ID_Opcion`,`ID_Usuario`,`ID_Consulta`) VALUES (AES_ENCRYPT('$check','$password'),$usuario,$idconsulta)";
$qstr= "INSERT INTO `Votaciones`(`ID_Opcion`,`ID_Usuario`,`ID_Consulta`) VALUES ('$check',$usuario,$idconsulta)";

$query=$con->prepare($qstr);
$query->execute();
$e= $query->errorInfo();
if ($e[0]!='00000') {
	die("Error accedint a dades: " . $e[2]);
	}
header('location: lista-preguntas.php')

//INSERT INTO `Votaciones`(`ID_Opcion`,`ID_Usuario`) VALUES (AES_ENCRYPT('22','holi'),2)
?>
