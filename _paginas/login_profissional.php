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
		echo "window.location.replace('../_adm/adm003.php');";
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
					<a class="nav-link" href="tipo.html"><img class="navbar-brand" src="../_icones/voltar.png" alt="" width="22" height="32">Voltar</a>
				</li>
			</ul>
		</div>
	</nav>
</header>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
			<div class="fadeIn first">
				<h1>Profissional</h1>
			</div>
			<form method="POST" action="">
				<input type="text" id="login" class="fadeIn second" name="id_profissional" placeholder="Usuário" required>
				<input type="password" id="password" class="fadeIn third" name="senha" placeholder="Senha" required>
				<input type="submit" class="fadeIn fourth" value="Entrar">
			</form>
			<div id="formFooter">
				<a class="underlineHover" href="registrar_profissional.php">Registrar-se</a>
			</div>
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

<?php
	include("../_conexao/conexao_profissional.php");
	
	if(isset($_POST['id_profissional']) || isset($_POST['senha'])){
		
		if(strlen($_POST['id_profissional'])== 0){
			echo "Preencha seu email";
		} else if (strlen($_POST['senha'])== 0){
			echo "Preencha sua senha";
		} else {
			
			$id_profissional = $mysqli->real_escape_string($_POST['id_profissional']);
			$senha = $mysqli->real_escape_string($_POST['senha']);
			
			$sql_code = "SELECT * FROM profissional WHERE id_profissional = '$id_profissional' AND senha = '$senha'";
			$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
			
			$quantidade = $sql_query->num_rows;
			
			if($quantidade == 1){
				
				$profissional = $sql_query->fetch_assoc();
				
				if(!isset($_SESSION)){
					session_start();
				}
				
				$_SESSION['id_usuario'] = $profissional['id_profissional'];
				$_SESSION['senha'] = $profissional['senha'];
				$_SESSION['nome'] = $profissional['nome'];
				$_SESSION['sobrenome'] = $profissional['sobrenome'];
				$_SESSION['cep'] = $profissional['cep'];
				$_SESSION['cidade'] = $profissional['cidade'];
				$_SESSION['uf'] = $profissional['uf'];
				$_SESSION['bairro'] = $profissional['bairro'];
				$_SESSION['rua'] = $profissional['rua'];
				$_SESSION['num'] = $profissional['num'];
				$_SESSION['telefone'] = $profissional['telefone'];
				$_SESSION['instagram'] = $profissional['insta'];
				$_SESSION['facebook'] = $profissional['face'];
				$_SESSION['whatsapp'] = $profissional['whatsapp'];
				$_SESSION['status'] = $profissional['status'];
						
				header("Location: ../_dashboard/main_profissional.php");
				
			} else {
				$sql_code_adm = "SELECT * FROM adm WHERE usuario = '$id_profissional' LIMIT 1";
				$sql_query_adm = $mysqli->query($sql_code_adm) or die("Falha na execução do código SQL" . $msqli->error);
			
				$quantidade_adm = $sql_query_adm->num_rows;
				
				if($quantidade_adm==0){
					echo "<script> alert('Usuário ou senha inválidos!!'); </script>";
				} else {
					
					$adm = $sql_query_adm->fetch_assoc();
					
					if(password_verify($senha, $adm['senha_adm'])){
						
						if(!isset($_SESSION)){
							session_start();
						}
						
						$_SESSION['nome_adm'] = $adm['nome'];
						$_SESSION['sobrenome_adm'] = $adm['sobrenome'];
						$_SESSION['id_adm'] = $adm['id'];
						$_SESSION['nivel'] = $adm['nivel'];
						
						header("Location: ../_adm/adm003.php");
						
					} else {
						echo "<script> alert('Você errou a senha de administrador!!'); </script>";
					}
					
				}
				
			}
			
		}
		
	}

?>

</html>