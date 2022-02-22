<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_adm'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_SESSION['serv'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_SESSION['serv'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_POST['especialidade_servico'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	$especialidade_servico = $_POST['especialidade_servico'];
	$descricao_servico = $_POST['descricao'];
	$categoria_servico = $_POST['categoria'];
	$id_servico = $_SESSION['serv'];
	
	include("../_conexao/conexao_login.php");
			
	$edita_servico = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE servico SET especialidade = '$especialidade_servico', descricao = '$descricao_servico', id_categoria = '$categoria_servico' WHERE servico.id_servico = '$id_servico'";
	mysqli_query($edita_servico,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($edita_servico);

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Services</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../_icones/icone.png"/>
		<link rel="stylesheet" href="../_css/menu.css"/>
		<link rel="stylesheet" href="../_css/dashboard.css"/>
		<link rel="stylesheet" href="../_css/footer.css"/>
		<link rel="stylesheet" href="../_css/aside.css"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/1e592b5726.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</head>

<body class="fundo">
<header>
	<nav class="navegacao">
		<?php
		if(!isset($_SESSION)){
				session_start();
			}
			
			if(!isset($_SESSION['id_usuario'])){
				if(isset($_SESSION['id_adm'])){
					
					$nome_adm = $_SESSION['nome_adm'];
					
					echo "<div class='row'>";
					echo	"<ul class='nav justify-content-end'>";
					echo		"<li class='nav-item'>";
					echo			"<a class='nav-link' href='adm003.php'><img class='navbar-brand' src='../_icones/painel.png' alt='' width='32' height='42'>$nome_adm | PAINEL DE CONTROLE</a>";
					echo		"</li>";
					echo	"</ul>";
					echo "</div>";
				} else {
					echo "<div class='row'>";
					echo	"<ul class='nav justify-content-end'>";
					echo		"<li class='nav-item'>";
					echo			"<a class='nav-link' href='../_paginas/tipo.html'><img class='navbar-brand' src='../_icones/entre.png' alt='' width='22' height='32'>Entre</a>";
					echo		"</li>";
					echo		"<li class='nav-item'>";
					echo			"<a class='nav-link' href='../_paginas/tipo.html'><img class='navbar-brand' src='../_icones/notificacoes.png' alt='' width='22' height='32'>Notificações</a>";
					echo		"</li>";
					echo	"</ul>";
					echo "</div>";
				}
			}
			
		?>
		<div class="row">
			<nav class="navbar-light">
			<div class="container">
				<form class="d-flex justify-content-center pesquisa" method="get" action='../_paginas/busca.php'>
					<img class="logo" src="../_icones/icone_layout.png" width="170" height="42">
					<input class="form-control me-6" type="search" placeholder="Buscar profissionais" name="q" aria-label="Search">
					<button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
				</form>
				
			</div>
			</nav>
		</div>
		<div class="row">
			<nav class="categoria">
			<ul class="nav categoria justify-content-center">
				<li class="nav-item">
					<a class="nav-link"href="../index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<?php
					
						include("../_conexao/conexao_profissional.php");
						
						$sql_selecionar_categorias = "SELECT * FROM categoria ORDER BY nome";
						$sql_query_selecionar = $mysqli->query($sql_selecionar_categorias) or die("Falha na execução do código SQL" . $msqli->error);
						
						while($selecionar_categorias = mysqli_fetch_array($sql_query_selecionar)){
							$categoria_nome = $selecionar_categorias['nome'];
							$id_categoria = $selecionar_categorias['id_categoria'];
							echo "<li><a class='dropdown-item' href='../_paginas/categorias.php?id=$id_categoria'>$categoria_nome</a></li>";
						}
					
					?>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../_paginas/como_funciona.php">Como Funciona?</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../_paginas/anuncie.php">Anuncie</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../_paginas/sobre.php">Sobre</a>
				</li>
			</ul>
		</nav>
		</div>
	</nav>
</header>

	<div class="content painel">
		<div class="main-painel">
			<div class="row">
				<?php
				
					$cod_servico = $_SESSION['serv'];
					echo "<div>";
					echo "<span style='text-align: center; font-family: Verdana; font-size: 30px; color: #16578b; font-weight: bold;'>REGIÕES DE ATENDIMENTO DESSE SERVIÇO</span>";
					echo "<form method='POST'>";

					$sql_code = "SELECT * FROM regiao WHERE id_servico = '$cod_servico'";
					$sql_query_regiao = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
					
						echo "<table class='table table-bordered'>";
						echo 	"<tbody>";
						echo 	"<thead>";
						echo 		"<tr>";
						echo 		"<th scope='col'>Cidade</th>";
						echo 		"<th scope='col'>Estado</th>";
						echo 		"<th scope='col'>Opções</th>";
						echo 		"</tr>";
						echo 	"</thead>";
					
						while ($regioesdeservico = mysqli_fetch_array($sql_query_regiao)){
							$regiao = $regioesdeservico['regiao'];
							$estado = $regioesdeservico['estado'];
							$id_regiao = $regioesdeservico['id_regiao'];
							echo 	"<tr>";
							echo 		"<td class='col-8' style='font-size: 15pt; padding: 20px;'>$regiao</td>";
							echo 		"<td class='col-8' style='font-size: 15pt; padding: 20px;'>$estado</td>";
							echo 		"<td style='padding: 20px;'><a class='abutaoexcluir' href='adm007-excluir_regioes.php?cod_regiao=$id_regiao'>Excluir</a></td>";
							echo 	"</tr>";
						}
					echo 	"</tbody>";	
					echo "</table>";	
					echo 	"</form>";
					echo 	"<form method='POST' action='adm007-servicos.php'>";
					echo 		"<br><button type='submit' class='btn btn-success'>Terminar</button>";
					echo 	"</form>";
					echo "</div>";
			?>
			</div>
		</div>
    </div>
	
    <footer id="myFooter" class="footer navbar-fixed-bottom">
        <div class="footer-copyright">
            <p>© 2021 Copyright</p>
        </div>
    </footer>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script type="text/javascript" >
		$(document).ready(function(){
			$("#notificationLink").click(function(){
				$("#notificationContainer").fadeToggle(400);
				$("#notification_count").fadeOut("slow");
				return false;
			});

		$(document).click(function(){
			$("#notificationContainer").hide();
			
		});

		});
	</script>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>