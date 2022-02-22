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
	
	if(!isset($_POST['usuario'])){
		echo "<script>";
		echo "window.location.replace('../_dashboard/main_usuario.php');";
		echo "</script>";
	}

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$database = 'services';
	$host = 'localhost';
	
	if($usuario == 'root' AND $senha == ''){
		$mysqli = new mysqli($host, $usuario, $senha, $database);
		if ($mysqli->error){
			echo "<script>";
			echo "window.location.replace('../index.php');";
			echo "</script>";
		}
	} else {
		echo "<script>";
		echo "alert('USUÁRIO NEGADO!');";
		echo "window.location.replace('adm000.php');";
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
		<link rel="stylesheet" href="../_css/registrar.css"/>
		<link rel="stylesheet" href="../_css/footer.css"/>
		<link href="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
		<script language="javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
		<script language="javascript" src="../_javascript/consultacep.js"></script>
	</head>

<body class="fundo">
<header>
	<nav class="navegacao">
		<div class="">
			<ul class="nav justify-content-end">
				<li class="nav-item">
					<a class="nav-link" href="login_profissional.php"><img class="navbar-brand" src="../_icones/entre.png" alt="" width="22" height="32">Login</a>
				</li>
			</ul>
		</div>
	</nav>
</header>
	<div class="container wrapper cad" style="min-height: 100%;"><br>
		<form method="POST" action="adm002.php">
			<fieldset>
				<legend class="ini">- ADM -</legend>
				<div class="row">
					<div class="col-5">
						<label for="nome" class="form-label">Nome</label>
						<input type="text" class="form-control" name="nomeADM" placeholder="Nome" id="nome" aria-label="nome" required>
					</div>
					<div class="col">
						<label for="sobrenome" class="form-label">Sobrenome</label>
						<input type="text" name="sobrenomeADM" class="form-control" placeholder="Sobrenome" id="sobrenome" aria-label="sobrenome" required>
					</div>
				</div><br>
				<div class='mb-1' style='text-align: left;'>
					<label for='nivel' class='form-label'>Nível</label><br>
						<select class='form-select' id='nivel'  name='nivel' required>
						<option selected value='1'>Nível</option>
						<option value='1'>Permissão Total</option>
						<option value='2'>Moderador</option>
						<option value='3'>Suporte</option>
					</select>
				</div><br>
				<div class="mb-3">
					<label for="usuario" class="form-label">Usuário</label>
					<input type="text" class="form-control" name="usuarioADM" id="usuario" required>
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha</label>
					<input type="password" class="form-control" name="usuarioSenha" id="senha" required>
				</div>
				<br><div class="right">
					<button type="reset" class="btn btn-danger">Limpar</button>
					<button type="submit" class="btn btn-success">Cadastrar</button>
				</div>
			</form>
	</div>
	<footer id="myFooter">
        <div class="footer-copyright">
            <p>© 2021 Copyright</p>
        </div>
    </footer>

	<script>
		$("#telefone").mask("(99) 9 9999-9999");
		$("#zap").mask("(99) 9999-9999");
		$("#cep").mask("99999-999");
	</script>
</body>

</html>