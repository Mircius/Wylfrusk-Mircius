<?php
// datos para la conexion a mysql
 	$hostname = "localhost";
    $dbname = "BBDDProjectVota";
    $username = "root";
    $pw = "";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
  } catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }
?>