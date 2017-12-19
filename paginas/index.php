<!DOCTYPE html>
<html>
<head>
	<title>Pagina login</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed" rel="stylesheet">
	<style>
		html, body{
			font-family: 'Barlow Semi Condensed', sans-serif;
			height: 100%;
		}
		.container{
			width: 100%;
			height: 100%;
			background-size: cover;
			box-sizing: border-box;
		}
		.formu{
			color:rgba(110,110,110,0.9);
			background-color:rgba(255,255,255,0.8);;
			margin-left: auto;
			margin-right: auto;
			margin-top: auto;
			display: block;
			width: 30em;
			height: 35em;
			border-radius: 0.4em;
			box-shadow: 0px 0px 20px #111111;

			position:absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%,-50%);
		}
		.formu h1{
			font-family: 'Barlow Semi Condensed', sans-serif;
			font-size: 2em;
			padding: 1em;
		}
		.formu label{
			font-size: 1.5em;
			padding-left: 1em;

		}
		.formu input{
			background-color: rgba(110,110,110,0.9);
			color:white;
			margin-top:1.2em;
			margin-bottom:1.2em;
			margin-left: auto;
			margin-right: auto;
			display: block;
			border: none;
			padding: 10px;
			width: 85%;
		}
		.formu button{
			border:solid 2px rgba(110,110,110,0.9);
			background-color: rgba(1,1,1,0);
			color:rgba(110,110,110,0.9);
			padding:1em;
			padding-left: 1.5em;
			padding-right: 1.5em;
			margin-right: auto;
			margin-left: auto;
			display: block;
		}
		.formu button:hover{
			background-color: rgba(110,110,110,0.2);
		}
		.formu button:active{
			background-color: rgba(255,255,255,0.8);
			color:black;
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
		/*----------------------------------------------------------------------------------
		form.login {
    background: none repeat scroll 0 0 #F1F1F1;
    border: 1px solid #DDDDDD;
    font-family: sans-serif;
    margin: 0 auto;
    padding: 20px;
    width: 278px;
}
form.login div {
    margin-bottom: 15px;
    overflow: hidden;
}
form.login div label {
    display: block;
    float: left;
    line-height: 25px;
}
form.login div input[type="text"], form.login div input[type="password"] {
    border: 1px solid #DCDCDC;
    float: right;
    padding: 4px;
}
form.login div input[type="submit"] {
    background: none repeat scroll 0 0 #DEDEDE;
    border: 1px solid #C6C6C6;
    float: right;
    font-weight: bold;
    padding: 4px 20px;
}
.error{
    color: red;
    font-weight: bold;
    margin: 10px;
    text-align: center;
}*/
	</style>
</head>
<body>
	<?php
session_start();
include_once('conexion.php');

function verificar_login($user,$password,$con) {
	$password = hash('sha256',$password);
	echo $password;
	$qstr = "SELECT * FROM Usuario WHERE Usuario = '$user' and Contrasena = '$password'";
	$query = $con->prepare( $qstr );
  	$query->execute();
  	$row = $query->fetch();
  	$count = 0;
  	$e= $query->errorInfo();
	if ($e[0]!='00000') {
		die("Error accedint a dades: " . $e[2]);
	}
	while ($row) {
		if ($row['Usuario'] == $user){
			if ($row['Contrasena'] == $password){
				$count++;
				$GLOBALS['result']=$row;
				
			}
		}
		$row = $query->fetch();
	}
	if ($count == 1){
		return 1;
	}
	else{
		return 0;
	}
}
if(!isset($_SESSION['userid']))
{
    if(isset($_POST['login']))
    {
        if(verificar_login($_POST['user'],$_POST['password'],$con) == 1)
        {	echo $GLOBALS['result']['ID_Usuario'];
            $_SESSION['userid'] = $GLOBALS['result']['ID_Usuario'];
            $_SESSION['user'] = $_POST['user'];
			$_SESSION['admin'] = $GLOBALS['result']['Administrador'];
            header("location:home.php");
        }
        else
        {
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
        }
    }
?>
	<section class="container">
		
		<form action="" method="POST" class="formu">
			<div class="logo">
			<img src="img/projectvota-01-01.png">
		</div>
			<h1>Inicio de sesión</h1>
			<label><b>Nombre de usuario</b></label>
			<input type="text" name="user" required>
			<label><b>Contraseña</b></label>
			<input type="password" name="password" required>
			<button type="submit" name="login" value="login">Login</button>
		</form>
	</section>

<?php
} else {
	echo 'Su usuario ingresó correctamente.';
	echo '<a href="logout.php">Logout</a>';
}
?>


</body>
</html>