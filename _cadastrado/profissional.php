<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Services</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../_icones/icone.png"/>
		<link rel="stylesheet" href="../_css/menu.css"/>
		<link rel="stylesheet" href="../_css/cadastrado.css"/>
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
					<a class="nav-link" href="../_paginas/login_profissional.php"><img class="navbar-brand" src="../_icones/entre.png" alt="" width="22" height="32">Login</a>
				</li>
			</ul>
		</div>
	</nav>
</header>

	<div class="container cadheight cadastrado">
		<legend class="cadastrosucesso">Você está pronto para prestar serviço!</legend><br>
        <div class="row">
			<div class="col">
			<div class="idusuario" style="padding: 20px;">
				<table>
				<tr>
					<td>
						<img src="../_icones/_tipo/sou_profissional.png" style="padding: 10px;" class="figure-img img-fluid rounded" width="240" height="240" alt="">
					</td>
					<td>
						<h4 style="text-align: center;">O seu ID de acesso está pronto!</h4>
						<div class="idusuario">
							<?php
								$conexao = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
								$sql = " SELECT MAX(id_profissional) as id_profissional FROM profissional";
								$ultimo_id = mysqli_query($conexao,$sql) or die("Erro ao retornar dados");
		
								while ($registro = mysqli_fetch_array($ultimo_id)){
									$id_profissional = $registro['id_profissional'];
									echo "<h1 style='text-align: center; font-size: 50px;'>$id_profissional</h1>";
								}
								mysqli_close($conexao);
							?>
						</div>
						<h6 style="text-align: center; color: red; font-weight: bold;">Não perca o seu código de acesso!</h6>
					</td>
				<tr>
				</table>
			</div>
			</div>
		</div><br>
		<form action="../_paginas/login_profissional.php" class="right">
			<button type="submit" class="btn btn-success">FAZER MEU PRIMEIRO LOGIN</button>
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