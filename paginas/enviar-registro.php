<!-- Nom del fitxer: enviar-registro.php
Data de creació: 28/11/2017
Nom del creador: Jose Gonzalez
Descripció de la funcionalitat: Este codigo permite insertar los datos de la creacion de usuarios. -->

<?php
session_start();
include_once('conexion.php');
$password = hash('sha256',$_POST['password']);

$qstr= "INSERT INTO `Usuario`(`Nombre`,`Apellido`,`Usuario`,`Contrasena`,`Email`,`Administrador`) VALUES (?,?,?,?,?,0)";
$query=$con->prepare($qstr);
$query->execute([$_POST['nombre'],$_POST['apellido'],$_POST['user'],$password,$_POST['email']]);
$e= $query->errorInfo();
if ($e[0]!='00000') {
	die("Error accedint a dades: " . $e[2]);
	}
header('location: lista-preguntas.php')
?>