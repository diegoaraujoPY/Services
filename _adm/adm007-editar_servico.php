<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_adm'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_GET['id_serv'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
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
				
					echo "<span style='padding: 30px; color: #16578b; font-size: 30px; font-family: Verdana; font-weight: bold; text-align: center;'>ADICIONAR NOVA CATEGORIA</span>";
					
					$id_servico = $_GET['id_serv'];
					$_SESSION['serv'] = $id_servico;
					
					include('../_conexao/conexao_login.php');
					
					$sql_servico = "SELECT * FROM servico WHERE id_servico = '$id_servico'";
					$sql_query_servico = $mysqli->query($sql_servico) or die ("Falha na execução do código SQL " . $mysqli->error);
					
					while($servico = mysqli_fetch_array($sql_query_servico)){
						$id_categoria = $servico['id_categoria'];
						$especialidade = $servico['especialidade'];
						$descricao = $servico['descricao'];
						
						$sql_categoria = "SELECT * FROM categoria";
						$sql_query_categoria = $mysqli->query($sql_categoria) or die ("Falha na execução do código SQL " . $mysqli->error);
						
						echo "<div>";
						echo "<span style='font-size: 30px; font-family: Verdana; color: #16578b; font-weight: bold; text-align: center;'>CADASTRAR SERVIÇO!</span>";
						echo "<form method='POST' action='adm007-editar_regioes.php'>";
						echo 	"<div class='mb-1' style='text-align: left;'>";
						echo 		"<label for='especialidade' class='form-label'>ESPECIALIDADE</label><br>";
						echo 		"<input type='text' name='especialidade_servico'  class='form-control' value='$especialidade' placeholder='Pedreiro, Eletricista, Encanador...' id='especialidade' required>";
						echo 	"</div>";
						echo 	"<div class='mb-1' style='text-align: left;'>";
						echo 		"<label for='descricao' class='form-label'>DESCRIÇÃO</label><br>";
						echo 			"<textarea name='descricao' type='text' class='form-control' placeholder='Descrição'  rows='7' id='descricao' required/>$descricao";
						echo 		"</textarea>";
						echo 	"</div>";
						echo 	"<div class='mb-1' style='text-align: left;'>";
						echo 		"<label for='categoria' class='form-label'>CATEGORIA</label><br>";
						echo 		"<select class='form-select' id='categoria'  name='categoria' required>";
						echo 			"<option value='1'>Escolha uma categoria</option>";
						
						while($categoria = mysqli_fetch_array($sql_query_categoria)){
							$nome = $categoria['nome'];
							$id_cat = $categoria['id_categoria'];
							
							if($id_cat==$id_categoria){
								echo 	"<option value='$id_cat' selected>$nome</option>";
							} else {
								echo 	"<option value='$id_cat'>$nome</option>";
							}
							
						}
						
						echo 		"</select>";
						echo 	"</div>";
						echo 	"<br><button type='submit' class='btn btn-primary'>Próximo</button>";
						echo 	"</form>";
						echo "</div>";	
					}
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