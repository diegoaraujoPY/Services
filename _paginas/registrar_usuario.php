<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(isset($_SESSION['id_usuario'])){
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
		<link rel="stylesheet" href="../_css/registrar.css"/>
		<link rel="stylesheet" href="../_css/footer.css"/>
		<link href="//cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
					<a class="nav-link" href="login_usuario.php"><img class="navbar-brand" src="../_icones/entre.png" alt="" width="22" height="32">Login</a>
				</li>
			</ul>
		</div>
	</nav>
</header>
	<div class="container wrapper cad"><br>
		<form method="POST" action="../_conexao/inserir_usuarios.php">
			<fieldset>
				<legend class="ini">Cadastro de Usuário</legend>
				<div class="row">
					<div class="col-5">
						<label for="nome" class="form-label">Nome</label>
						<input type="text" class="form-control" name="nomeUsuario" placeholder="Nome" id="nome" aria-label="nome" required>
					</div>
					<div class="col">
						<label for="sobrenome" class="form-label">Sobrenome</label>
						<input type="text" name="sobrenomeUsuario" class="form-control" placeholder="Sobrenome" id="sobrenome" aria-label="sobrenome" required>
					</div>
				</div><br>
				<div class="mb-3">
					<label for="nasc" class="form-label">Data de Nascimento</label>
					<input type="date" name="nascUsuario"  class="form-control" id="nasc">
				</div>
				<div class="mb-3">
					<label for="cep" class="form-label">CEP</label>
					<input name="cepUsuario" type="text" id="cep" class="form-control" value="" maxlength="8" onblur="pesquisacep(this.value);" required />
				</div>
				<div class="row">
					<div class="col-8">
						<label for="cidade" class="form-label">Cidade</label>
						<input type="text" class="form-control" name="cidadeUsuario" id="cidade" required >
					</div>
					<div class="col-2">
						<label for="estado" class="form-label">UF</label><br>
						<input type="text" class="form-control" name="estadoUsuario" id="uf" required>
					</div>
				</div><br>
				<div class="mb-3">
					<label for="bairro" class="form-label">Bairro</label>
					<input type="text" class="form-control" name="bairroUsuario" id="bairro" required>
				</div>
				<div class="row">
					<div class="col-10">
						<label for="rua" class="form-label">Rua</label>
						<input type="text" class="form-control" name="ruaUsuario" id="rua" required>
					</div>
					<div class="col">
						<label for="numero" class="form-label">n°</label>
						<input type="number" class="form-control" name="numUsuario" id="numero"required>
					</div>
				</div><br>
				<div class="mb-3">
					<label for="telefone" class="form-label">Telefone</label>
					<input type="text" class="form-control" name="tellUsuario" id="telefone" required>
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha</label>
					<input type="password" class="form-control" name="senhaUsuario" id="senha" required>
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
		$("#cep").mask("99999-999");
	</script>
</body>

</html>