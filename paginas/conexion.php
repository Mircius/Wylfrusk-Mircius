<!-- Nom del fitxer: conexion.php
Data de creació: 22/11/2017
Nom del creador: Jose Gonzalez
Descripció de la funcionalitat: Este codigo permite la conexion con la base de datos. -->

<?php
// datos para la conexion a mysql
try{
 	$hostname = "localhost";
    $dbname = "BBDDProjectVota";
    $username = "root";
    $pw = "";
    $con = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
	$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
?>