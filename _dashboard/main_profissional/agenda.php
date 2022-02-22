<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(!isset($_SESSION['status'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?php	
					
					$nome_usuario = $_SESSION['nome'];
					echo "$nome_usuario | ";
				?>Agenda</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../../_icones/icone.png"/>
		<link rel="stylesheet" href="../../_css/menu.css"/>
		<link rel="stylesheet" href="../../_css/dashboard.css"/>
		<link rel="stylesheet" href="../../_css/footer.css"/>
		<link rel="stylesheet" href="../../_css/aside.css"/>
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
					echo			"<a class='nav-link' href='../main_profissional.php'><img class='navbar-brand' src='../../_icones/entreprofissional.png' alt='' width='22' height='32'>$nome_profissional</a>";
					echo		"</li>";
					echo		"<li class='nav-item' id='notification_li'>";
					
					include("../../_conexao/conexao_profissional.php");
					
					$sql_code_not = "SELECT * FROM servico WHERE id_profissional = $id_profissional AND aceitar NOT IN (0)";
					$sql_query_not = $mysqli->query($sql_code_not) or die("Falha na execução do código SQL" . $msqli->error);
			
					$quantidade = $sql_query_not->num_rows;
					
					if($quantidade==0){
						echo	"<a class='nav-link' id='notificationLink' href='#'><img class='navbar-brand' src='../../_icones/notificacoes.png' alt='' width='22' height='32'>Notificações</a>";
					} else {
						echo	"<a class='nav-link' id='notificationLink' href='#'><span id='notification_count'>$quantidade</span><img class='navbar-brand' src='../../_icones/notificacoes.png' alt='' width='22' height='32'>Notificações</a>";
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
														echo 			"<a class='abutaoexcluir' style='margin: 10px;' href='solicitacao.php?c=$id_servico'>Analisar</a>";
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
				<form class="d-flex justify-content-center pesquisa" method="get" action='../../_paginas/busca.php'>
					<img class="logo" src="../../_icones/icone_layout.png" width="170" height="42">
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
					<a class="nav-link"href="../../index.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorias</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<?php
					
						include("../../_conexao/conexao_profissional.php");
						
						$sql_selecionar_categorias = "SELECT * FROM categoria";
						$sql_query_selecionar = $mysqli->query($sql_selecionar_categorias) or die("Falha na execução do código SQL" . $msqli->error);
						
						while($selecionar_categorias = mysqli_fetch_array($sql_query_selecionar)){
							$categoria_nome = $selecionar_categorias['nome'];
							$id_categoria = $selecionar_categorias['id_categoria'];
							echo "<li><a class='dropdown-item' href='../../_paginas/categorias.php?id=$id_categoria'>$categoria_nome</a></li>";
						}
					
					?>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../../_paginas/como_funciona.php">Como Funciona?</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../../_paginas/anuncie.php">Anuncie</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../../_paginas/sobre.php">Sobre</a>
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
					$id_profissional = $_SESSION['id_usuario'];
					echo "<span style='font-size: 35px; font-family: Verdana; color: #16578b; font-weight: bold; text-align: center;'>MINHA AGENDA!</span>";
					
					include("../../_conexao/conexao_profissional.php");
					
					$sql_code = "SELECT * FROM contrato AS c JOIN servico AS s ON c.id_servico = s.id_servico JOIN usuario AS u ON c.id_usuario = u.id_usuario WHERE s.id_profissional = '$id_profissional'";
					$sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
			
					$quantidade = $sql_query->num_rows;
			
					if($quantidade == 0){
				
						echo "<span style='padding: 30px; color: red; font-size: 20px; font-family: Verdana; text-align: left;'>NENHUM SERVIÇO ATÉ O MOMENTO!</span>";
						echo "<form action='../main_profissional.php'>";
						echo "<br><button type='submit' class='btn btn-primary'>Voltar</button>";
						echo "</form>";
							
					} else {	
						
					while ($servico = mysqli_fetch_array($sql_query)){
						$id_contrato = $servico['id_contrato'];
						$especialidade = $servico['especialidade'];
						$descricao = $servico['descricao'];
						$id_servico = $servico['id_servico'];
						$nome_usuario = $servico['nome'];
						$sobrenome_usuario = $servico['sobrenome'];
						$id_profissional_servico = $servico['id_profissional'];
						$id_categoria_servico = $servico['id_categoria'];
						$id_usuario = $servico['id_usuario'];
						$data_servico = $servico['data'];
						$cidade_usuario = $servico['cidade'];
						$uf_usuario = $servico['uf'];
						$data_fim = $servico['data_final'];
						
						echo "<script language=javascript>";
						echo "function confirmar_termino(){";
						echo 	"if (confirm('Finalizar serviço?')){";
						echo 		"alert('Serviço finalizado - Aguarde avaliação!!');";
						echo 		"window.location.replace('../manipulacao/terminar_servico.php?c=$id_servico&cli=$id_usuario&con=$id_contrato');";
						echo 	"} else {";
						echo 		"window.location.replace('agenda.php');";
						echo 	"}";
						echo "}";
						echo "</script>";
						
							echo "<div class='container justify-content opcoes' style='padding: 20px; margin-top: 10px;'>";
							echo 	"<form action='../main_profissional.php' style='padding: 10px;'>";
							echo 		"<div class='row'>";
							echo 			"<div class='col-3' style='padding: 20px;'>";
							echo 				"<img class='img-fluid' src='../../_icones/_tipo/sou_usuario.png' alt='' width='110' height='121'>";
							echo 			"</div>";
							echo 			"<div class='col' style='padding: 10px; text-align: left;'>";
							echo 				"<span style='font-family: Verdana; font-size: 18px; text-align: left;'><b>Cliente:</b> $nome_usuario $sobrenome_usuario</span><br>";
							echo 				"<span style='font-family: Verdana; font-size: 18px; text-align: left;'><b>Local:</b> $cidade_usuario-$uf_usuario</span><br>";
							echo 				"<span style='font-family: Verdana; font-size: 18px; text-align: left;'><b>Serviço:</b> $especialidade</span><br>";
							
							if($data_servico==0){
								echo "<span style='font-size: 18px; text-align: left; color: red;'><b>CANCELADO PELO CLIENTE</b></span><br>";
								echo 	"</div>";
								echo "<div style='text-align: right;'>";
								echo 	"<a class='abutao' style='margin: 10px; background: red' href='../manipulacao/excluir_servico_cancelado.php?icontrato=$id_contrato'>EXCLUIR</a>";
							} else {
							
								echo "<span style='font-family: Verdana; font-size: 18px; text-align: left;'><b>Iniciado em:</b> $data_servico</span><br>";
							
								if($data_fim=='0'){
										
								} else {
									echo 	"<span style='font-family: Verdana; font-size: 18px; text-align: left;'><b>Finalizado:</b> $data_fim</span><br>";
								}
				
								echo 		"</div>";
								echo "<div style='text-align: right;'>";
							
								$sql_contrato = "SELECT * FROM contrato WHERE id_servico = '$id_servico' AND id_usuario = '$id_usuario' AND data_final = '0' AND id_contrato = '$id_contrato'";
								$sql_query_contrato = $mysqli->query($sql_contrato) or die("Falha na execução do código SQL" . $msqli->error);
							
								$quant_servico_andamento = $sql_query_contrato->num_rows;

								if($quant_servico_andamento==0){
									echo 	"<a class='abutao' style='background: #168b87'>AGUARDANDO POR AVALIAÇÃO</a>";
								} else {
									echo 	"<a class='abutaoexcluir' href='' onclick='confirmar_termino()'>Terminar</a>";
								}
								echo 	"</div>";
								echo "</div>";
								
							}
							
							echo 	"</div>";
							
							}
							echo 		"</div>";
							echo "<div style='padding: 10px;' >";
							echo 	"<br><button type='submit' class='btn btn-primary'>Voltar</button>";
							echo "</div>";
							echo "</form>";
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