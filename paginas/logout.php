<!-- Nom del fitxer: logout.php
Data de creació: 22/11/2017
Nom del creador: Jose Gonzalez
Descripció de la funcionalitat: Nos permite desloguearnos de la pagina. -->
<?php
	session_start();
	session_destroy();
	header("location:index.php");
?>