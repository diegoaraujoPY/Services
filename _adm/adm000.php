<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../_dashboard/main_usuario.php');";
		echo "</script>";
	}
	if(isset($_SESSION['id_adm'])){
		echo "<script>";
		echo "window.location.replace('../_dashboard/main_usuario.php');";
		echo "</script>";
	}

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Services</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../_icones/icone.png"/>
		<link rel="stylesheet" href="../_css/menu.css"/>
		<link rel="stylesheet" href="../_css/login.css"/>
		<link rel="stylesheet" href="../_css/footer.css"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/1e592b5726.js" crossorigin="anonymous"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	</head>

<body class="fundo">
<header>
	<nav class="navegacao">
		<div class="row">
			<ul class="nav justify-content-end">
				<li class="nav-item">
					<a class="nav-link" href="../_paginas/tipo.html"><img class="navbar-brand" src="../_icones/voltar.png" alt="" width="22" height="32">Voltar</a>
				</li>
			</ul>
		</div>
	</nav>
</header>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		
			<div class="fadeIn first">
				<h1>REGISTRAR ADM</h1>
			</div>
			<form method="POST" action="adm001.php">
				<input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Usuário" required>
				<input type="password" id="password" class="fadeIn third" name="senha" placeholder="Senha">
				<input type="submit" class="fadeIn fourth" value="Entrar">
			</form>
		</div>
	</div>
	
	<footer id="myFooter">
        <div class="footer-copyright">
            <p>© 2021 Copyright</p>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>