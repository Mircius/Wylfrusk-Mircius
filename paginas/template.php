<!DOCTYPE html>
<html>
<head>
	<title>Main</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		html, body{
			font-family: 'Barlow Semi Condensed', sans-serif;
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
		.table-fill {
		  border-radius:3px;
		  border-collapse: collapse;
		  height: 1em;
		  margin: auto;
		  margin-top: 20px;
		  max-width: 50em;
		  padding:5px;
		  width: 100%;
		  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
		}
		th {
		  color:#D5DDE5;;
		  background:#1b1e24;
		  border-bottom:4px solid #9ea7af;
		  border-right: 1px solid #343a45;
		  font-size:1.5em;
		  padding:24px;
		  text-align:center;
		}		  
		tr {
		  border-top: 1px solid #C1C3D1;
		  border-bottom-: 1px solid #C1C3D1;
		  color:#666B85;
		  font-size:1em;
		}
		tr:hover td {
		  background:#4E5066;
		  color:#FFFFFF;
		}
		
		 
		tr:nth-child(odd) td {
		  background:#EBEBEB;
		}
		 
		tr:nth-child(odd):hover td {
		  background:#4E5066;
		}		 
		td {
		  background:#FFFFFF;
		  padding:20px;
		  text-align:left;
		  vertical-align:middle;
		  font-size:1em;
		  border-right: 1px solid #C1C3D1;
		}
		th.text-left {
		  text-align: left;
		}

		td.text-left {
		  text-align: left;
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
		.workin{
			margin-left: auto;
			margin-right: auto;
			display:block;
			width: 60%;
			height: 90%;
			padding-top:1em;
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
				<a href="consultas.php"><i class="fa fa-plus-square-o"></i>  Crear pregunta</a>
			</div>
			<div class="headerDivider"></div>
			<div class="navbar-option">
				<a href="lista-preguntas.php"><i class="fa fa-folder-open"></i>  Lista preguntas</a>
			</div>
			
			<div class="navbar-option-dos">
				<a href="logout.php"><i class="fa fa-window-close"></i>   Log out</a>
			</div>
			<div class="headerDivider-dos"></div>
			<div class="navbar-option-dos">
				<a href=""><i class="fa fa-hand-spock-o"></i> <?php 
				if (isset($_SESSION['user'])){
					echo $_SESSION['user'];
				}; ?></a>
			</div>
		</div>
	</section>
	<section class="container">
		<div class="main-container">
			<div class="workin">
				
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