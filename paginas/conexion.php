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