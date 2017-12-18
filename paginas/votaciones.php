<!DOCTYPE html>
<html>
<head>
	<title>Main</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

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
			background-color: rgba(200,200,200,0.9);
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
			padding-top: 0.5em;
			padding-bottom: 0.5em;
			margin-left:30px;
			margin-right:30px;
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
		.QA, .QA2{
			margin-left:auto;
			margin-right:auto;
			display:block;
			width: 50%;
			padding-top:2em;
		}
		.QA2 {
		  animation-duration: 4s;
		  animation-name: slidein;
		}
		@keyframes slidein {
		  from {
			margin-left:auto;
			margin-right:auto;
			display:block;
			width: 50%;
			padding-top:2em;
			opacity:0;
		  }

		  to {
			margin-left:auto;
			margin-right:auto;
			display:block;
			width: 50%;
			padding-top:2em;
		  }
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
	include_once('conexion.php');
	?>
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
				<a href="lista-consultas-usuario.php"><i class="fa fa-hand-spock-o"></i> <?php 
				if (isset($_SESSION['user'])){
					echo $_SESSION['user'];
				}; ?></a>
			</div>
		</div>
	</section>
	<section class="container">
		<div class="main-container">
			<div class="workin">
				<div class="QA">
					<?php
					$id = $_GET['id'];
					$qstr = "SELECT * FROM Consulta WHERE ID_Consulta = '$id'";
					$query = $con->prepare( $qstr );
					$query->execute();
					$row = $query->fetch();
					while ($row) {
						$consultaid = $row['ID_Consulta'];
						$consultadesc = $row['Desc_Pregunta'];
						$consultausuario = $row['ID_Usuario'];
						$consultafechainicio = $row['F_Inicio'];
						$consultafechafinal = $row['F_Final'];
						$row = $query->fetch();
					}
					echo "<h1>".$consultadesc."</h1>";
					?>
				</div>
				<div class="QA2">
					<form action ="enviar-votacion.php" method="POST">
					<?php
					$qstr = "SELECT * FROM Opcion WHERE ID_Consulta = '$id'";
					$query = $con->prepare( $qstr );
					$query->execute();
					$row = $query->fetch();
					while ($row) {
						$consultaidopcion = $row['ID_Opcion'];
						$consultadescripcion = $row['Descripcion'];
						echo '<input type="radio" name="check" value="'.$consultaidopcion.'" id="'.$consultaidopcion.'">'.$consultadescripcion.'<br>';					
						$row = $query->fetch();
					}
					?>
					<input type="password" name="password" required>
					<button type="submit" name="respuesta" value="respuesta">Enviar respuesta</button>
					</form>
				</div>
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