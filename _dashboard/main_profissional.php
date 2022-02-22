<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_SESSION['status'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_usuario.php');";;
		echo "</script>";
	}
	

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?php	
					$nome_usuario = $_SESSION['nome'];
					echo "$nome_usuario | ";
				?>Services</title>
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
			
			if(isset($_SESSION['id_usuario'])){
					$nome_profissional = $_SESSION['nome'];
					$id_profissional = $_SESSION['id_usuario'];
					echo "<div class='row'>"; 
					echo	"<ul class='nav justify-content-end' id='nav'>";
					echo		"<li class='nav-item'>";
					echo			"<a class='nav-link' href='../_dashboard/main_profissional.php'><img class='navbar-brand' src='../_icones/entreprofissional.png' alt='' width='22' height='32'>$nome_profissional</a>";
					echo		"</li>";
					echo		"<li class='nav-item' id='notification_li'>";
					
					include("../_conexao/conexao_profissional.php");
					
					$sql_code_not = "SELECT * FROM servico WHERE id_profissional = $id_profissional AND aceitar NOT IN (0)";
					$sql_query_not = $mysqli->query($sql_code_not) or die("Falha na execução do código SQL" . $msqli->error);
			
					$quantidade = $sql_query_not->num_rows;
					
					if($quantidade==0){
						echo	"<a class='nav-link' id='notificationLink' href='#'><img class='navbar-brand' src='../_icones/notificacoes.png' alt='' width='22' height='32'>Notificações</a>";
					} else {
						echo	"<a class='nav-link' id='notificationLink' href='#'><span id='notification_count'>$quantidade</span><img class='navbar-brand' src='../_icones/notificacoes.png' alt='' width='22' height='32'>Notificações</a>";
					}
					
					echo 		"<div id='notificationContainer'>";
					echo 			"<div id='notificationTitle'>Notificações</div>";
					echo 				"<div id='notificationsBody' class='notifications'>";
					
												while($servico_solicitado = mysqli_fetch_array($sql_query_not)){
													$id_servico = $servico_solicitado['id_servico'];
													$permissao = $servico_solicitado['aceitar'];
													$nome_especialidade = $servico_solicitado['especialidade'];
													
													$sql_cliente = "SELECT * FROM usuario WHERE id_usuario = $permissao";
													$sql_query_cliente = $mysqli->query($sql_cliente) or die("Falha na execução do código SQL" . $msqli->error);
													
													while($usuario_solicitado = mysqli_fetch_array($sql_query_cliente)){
														$nomeusuario = $usuario_solicitado['nome'];
														$sobrenomeusuario = $usuario_solicitado['sobrenome'];
														$cidadeusuario = $usuario_solicitado['cidade'];
														$ufusuario = $usuario_solicitado['uf'];
														
														echo 	"<div style='padding: 10px;'>";
														echo 	"<div class='nav justify-content-end solicitacao'>";
														echo 		"<div class='row' style='padding: 10px;'>";
														echo 			"<div class='col'>";
														echo 				"<span style='font-family: Verdana; font-size: 14px;'>$nomeusuario $sobrenomeusuario <b>enviou uma solicitação para o servico: $nome_especialidade</b></span><br>";
														echo 				"<br><span style='font-family: Verdana; font-size: 14px;'><b>Cidade: </b>$cidadeusuario-$ufusuario</span><br>";
														echo 			"</div>";
														echo 		"</div>";
														echo 		"<div style='margin-top: -30px; margin-right: -10px;'>";
														echo 			"<a class='abutaoexcluir' style='margin: 10px;' href='../_dashboard/main_profissional/solicitacao.php?c=$id_servico'>Analisar</a>";
														echo 		"</div>";
														echo 	"</div>";
														echo 	"</div>";
													}
													
												}
					
					echo 				"</div>";
					echo 			"</div>";
					echo 		"</div>";
					echo	"</li>";
					echo "</ul>";
					echo "</div>";
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
				echo "<div class='col-4'>";
				echo "<img class='figure-img img-fluid rounded' src='../_icones/_tipo/sou_profissional.png' alt='' width='128' height='128'><br>";
				$status_profissional = $_SESSION['status'];
						if($status_profissional == 'DISPONÍVEL'){
							echo "<img src='_icones/disponivel.png' width='15' height='15'/>";
							echo "<span style='text-align: center; font-size: 15px; padding: 10px'>$status_profissional</span><br>";
						} else {
							echo "<img src='_icones/indisponivel.png' width='15' height='15'/>";
							echo "<span style='text-align: center; font-size: 15px; padding: 10px'>$status_profissional</span><br>";
						}
				echo "</div>";
				echo "<div class='col perfil'>";
					
						$id_usuario = $_SESSION['id_usuario'];
						$nome_profissional = $_SESSION['nome'];
						$sobrenome_profissional = $_SESSION['sobrenome'];
						$cep_profissional = $_SESSION['cep'];
						$cidade_profissional = $_SESSION['cidade'];
						$uf_profissional = $_SESSION['uf'];
						$bairro_profissional = $_SESSION['bairro'];
						$rua_profissional = $_SESSION['rua'];
						$n_profissional = $_SESSION['num'];
						$telefone_profissional = $_SESSION['telefone'];
						$insta_profissional = $_SESSION['instagram'];
						$face_profissional = $_SESSION['facebook'];
						$zap_profissional = $_SESSION['whatsapp'];
						
						echo "<span>$nome_profissional $sobrenome_profissional</span><br>";
						echo "<span>$cep_profissional | $cidade_profissional-$uf_profissional</span><br>";
						echo "<span>$bairro_profissional</span><br>";
						echo "<span>$rua_profissional, n° $n_profissional</span><br>";
						echo "<img src='_icones/telefone.png' width='30' height='30'/>";
						echo "<span> $telefone_profissional </span><br>";
						
						if($insta_profissional == ''){
							
						} else {
							echo "<img src='_icones/insta.png' width='30' height='30'/>";
							echo "<span>@$insta_profissional</span><br>";
						}
						
						if($face_profissional == ''){
							
						} else {
							echo "<img src='_icones/face.png' width='30' height='30'/>";
							echo "<span>$face_profissional</span><br>";
						}
						
						if($zap_profissional == ''){
							
						} else {
							echo "<img src='_icones/zap.png' width='30' height='30'/>";
							echo "<span>$zap_profissional</span><br>";
						}
						
			
					?>
				</div>
			</div>
			<a class='nav-link' href='main_profissional/status.php'>
				<ul class="nav justify-content-left opcoes">
					<img class='navbar-brand' src='_icones/status.png' alt='' width='58' height='70'><span>Status</span>
				</ul>
			</a>
			<a class='nav-link' href='main_profissional/agenda.php'>
				<ul class="nav justify-content-left opcoes">
					<img class='navbar-brand' src='_icones/agenda.png' alt='' width='58' height='70'><span>Agenda</span>
				</ul>
			</a>
			<a class='nav-link' href='main_profissional/myservicos.php'>
				<ul class="nav justify-content-left opcoes">
					<img class='navbar-brand' src='_icones/myservicos.png' alt='' width='58' height='70'><span>Meus Serviços</span>
				</ul>
			</a>
			<a class='nav-link' href='main_profissional/configuracoes.php'>
				<ul class="nav justify-content-left opcoes">
					<img class='navbar-brand' src='_icones/configuracoes.png' alt='' width='58' height='70'><span>Meu ID | Configurações</span>
				</ul>
			</a>
			<a class='nav-link' href='sair.php'>
				<ul class="nav justify-content-left opcoes">
					<img class='navbar-brand' src='_icones/sair.png' alt='' width='58' height='70'><span>Sair</span>
				</ul>
			</a>
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