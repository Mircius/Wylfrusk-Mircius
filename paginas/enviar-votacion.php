<?php
session_start();
include_once('conexion.php');
$check = $_POST['check'];
$usuario = $_SESSION['userid'];
$qstr= "INSERT INTO `Votaciones`(`ID_Opcion`,`ID_Usuario`) VALUES ($check,$usuario)";
$query=$con->prepare($qstr);
$query->execute();
$e= $query->errorInfo();
if ($e[0]!='00000') {
	die("Error accedint a dades: " . $e[2]);
	}
header('location: lista-preguntas.php')
?>