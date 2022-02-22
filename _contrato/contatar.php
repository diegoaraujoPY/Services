<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_usuario.php');";;
		echo "</script>";
	}

	if(!isset($_GET['cod_servico'])){
		echo "<script>";
		echo "window.location.replace('../_paginas/login_usuario.php');";;
		echo "</script>";
	}
	
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title><?php	
		
					include("../_conexao/conexao_profissional.php");
		
					$cod_servico = $_GET['cod_servico'];
					
					$sql_servico = "SELECT * FROM servico AS s JOIN profissional AS p ON s.id_profissional = p.id_profissional WHERE id_servico ='$cod_servico'";
					$sql_query_servico = $mysqli->query($sql_servico) or die("Falha na execução do código SQL" . $msqli->error);
			
					while($servico = mysqli_fetch_array($sql_query_servico)){
						$nome_profissional = $servico['nome'];
						$especialidade = $servico['especialidade'];
						echo "$nome_profissional - $especialidade | "; 
					}

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
				if(!isset($_SESSION['status'])){
					$nome_usuario = $_SESSION['nome'];
					echo "<div class='row'>";
					echo	"<ul class='nav justify-content-end' id='nav'>";
					echo		"<li class='nav-item'>";
					echo			"<a class='nav-link' href='../_dashboard/main_usuario.php'><img class='navbar-brand' src='../_icones/entre.png' alt='' width='22' height='32'>$nome_usuario</a>";
					echo		"</li>";
					echo		"<li class='nav-item' id='notification_li'>";
					
					include("../_conexao/conexao_profissional.php");
					
					$id_usuario = $_SESSION['id_usuario'];
					
					$sql_code_avalie = "SELECT * FROM avalie AS a JOIN servico AS s ON a.id_servico = s.id_servico JOIN profissional AS p ON s.id_profissional = p.id_profissional WHERE id_usuario = $id_usuario";
					$sql_query_avalie = $mysqli->query($sql_code_avalie) or die("Falha na execução do código SQL" . $msqli->error);
			
					$quantidade_avalie = $sql_query_avalie->num_rows;
					
					$sql_code_contrato = "SELECT * FROM contrato AS c JOIN usuario AS u ON c.id_usuario = u.id_usuario WHERE u.id_usuario = $id_usuario AND c.data_final = 0";
					$sql_query_contrato = $mysqli->query($sql_code_contrato) or die("Falha na execução do código SQL" . $msqli->error);
			
					$quantidade_contrato = $sql_query_contrato->num_rows;
					
					$quantidade = $quantidade_contrato + $quantidade_avalie;
					
					if($quantidade==0){
						echo	"<a class='nav-link' id='notificationLink' href='#'><img class='navbar-brand' src='../_icones/notificacoes.png' alt='' width='22' height='32'>Notificações</a>";
					} else {
						echo	"<a class='nav-link' id='notificationLink' href='#'><span id='notification_count'>$quantidade</span><img class='navbar-brand' src='../_icones/notificacoes.png' alt='' width='22' height='32'>Notificações</a>";
					}
					
					echo 		"<div id='notificationContainer'>";
					echo 			"<div id='notificationTitle'>Notificações</div>";
					echo 				"<div id='notificationsBody' class='notifications'>";
					
												while($servico_avaliar = mysqli_fetch_array($sql_query_avalie)){								
													
													$id_servico = $servico_avaliar['id_servico'];
													$nome_profissional = $servico_avaliar['nome'];
													$sobrenome_profissional = $servico_avaliar['sobrenome'];
													$nome_especialidade = $servico_avaliar['especialidade'];
													
													$sql_code_avaliacao = "SELECT * FROM avaliacao AS a JOIN servico AS s ON a.id_servico = s.id_servico JOIN usuario AS u ON a.id_usuario = u.id_usuario WHERE a.id_usuario = $id_usuario AND a.id_servico = $id_servico";
													$sql_query_avaliacao = $mysqli->query($sql_code_avaliacao) or die("Falha na execução do código SQL" . $msqli->error);
													
													$quant_avaliacao = $sql_query_avaliacao->num_rows;
													
													if($quant_avaliacao==0){
													
														echo 	"<div style='padding: 10px;'>";
														echo 	"<div class='nav justify-content-end solicitacao'>";
														echo 		"<div class='row' style='padding: 10px;'>";
														echo 			"<div class='col'>";
														echo 				"<span style='font-family: Verdana; font-size: 14px;'>$nome_profissional $sobrenome_profissional <b> concluiu o servico: $nome_especialidade</b></span><br>";
														echo 				"<span style='font-family: Verdana; font-size: 12px;'>FAÇA UMA AVALIAÇÃO DO SERVIÇO!</b></span><br>";
														echo 			"</div>";
														echo 		"</div>";
														echo 		"<div style='margin-top: -30px; margin-right: -10px;'>";
														echo 			"<a class='abutao' style='margin: 10px;' href='_dashboard/avaliacao/avaliando_servico.php?cont=$id_servico'>Avaliar</a>";
														echo 		"</div>";
														echo 	"</div>";
														echo 	"</div>";
													} else {
														
														while($avaliacao_usuario = mysqli_fetch_array($sql_query_avaliacao)){
															$id_avaliacao = $avaliacao_usuario['id_av'];

														echo 	"<div style='padding: 10px;'>";
														echo 	"<div class='nav justify-content-end solicitacao'>";
														echo 		"<div class='row' style='padding: 10px;'>";
														echo 			"<div class='col'>";
														echo 				"<span style='font-family: Verdana; font-size: 14px;'>$nome_profissional $sobrenome_profissional <b> concluiu o servico: $nome_especialidade</b></span><br>";
														echo 				"<span style='font-family: Verdana; font-size: 12px;'>VOCÊ JÁ FEZ UMA AVALIAÇÃO ANTES!</b></span><br>";
														echo 			"</div>";
														echo 		"</div>";
														echo 		"<div style='margin-top: -30px; margin-right: -10px; padding: 10px;'>";
														echo 			"<a class='abutaoexcluir' style='margin: 10px;' href='_dashboard/avaliacao/manter_avaliacao.php?c=$id_servico'>Manter</a>";
														echo 			"<a class='abutao' style='margin: 10px;' href='_dashboard/avaliacao/editar_avaliação.php?a=$id_avaliacao&s=$id_servico'>Editar Avaliação</a>";
														echo 		"</div>";
														echo 	"</div>";
														echo 	"</div>";
														}
													}
												}
													
													while($contrato_aceito = mysqli_fetch_array($sql_query_contrato)){
														$id_servico = $contrato_aceito['id_servico'];
														$data_inicio = $contrato_aceito['data'];
														
														$sql_code_profissional = "SELECT * FROM servico AS s JOIN profissional AS p ON s.id_profissional = p.id_profissional WHERE s.id_servico = $id_servico";
														$sql_query_profissional = $mysqli->query($sql_code_profissional) or die("Falha na execução do código SQL" . $msqli->error);
														
														while($profissional_servico = mysqli_fetch_array($sql_query_profissional)){
															$especialidade = $profissional_servico['especialidade'];
															$nome_profissional = $profissional_servico['nome'];
															$sobrenome_profissional = $profissional_servico['sobrenome'];
															
															echo 	"<div style='padding: 10px;'>";
															echo 	"<div class='nav justify-content-end solicitacao'>";
															echo 		"<div class='row' style='padding: 10px;'>";
															echo 			"<div class='col'>";
															echo 				"<span style='font-family: Verdana; font-size: 14px;'>$nome_profissional $sobrenome_profissional<b> aceitou seu pedido para o serviço: $especialidade</b></span><br>";
															echo 				"<span style='font-family: Verdana; font-size: 12px;'>SERVIÇO INICIADO - AGUARDE PARA FAZER AVALIAÇÃO!</b></span><br>";
															echo 			"</div>";
															echo 		"</div>";
															echo 	"</div>";
															echo 	"</div>";
														}
													}
													
					
					echo 				"</div>";
					echo 			"</div>";
					echo 		"</div>";
					echo	"</li>";
					echo	"</ul>";
					echo "</div>";
					
				} else {
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
			}
			if(!isset($_SESSION['id_usuario'])){
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
							echo "<li><a class='dropdown-item' href='_paginas/categorias.php?id=$id_categoria'>$categoria_nome</a></li>";
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
				
						
						$cod_servico = $_GET['cod_servico'];
						
						include("../_conexao/conexao_profissional.php");
						
						$sql_code = "SELECT * FROM profissional p JOIN servico s ON p.id_profissional = s.id_profissional WHERE id_servico = '$cod_servico'";
						$sql_query_servico = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
			
						while ($servico_profissional = mysqli_fetch_array($sql_query_servico)){
								$nome_profissional = $servico_profissional['nome'];
								$sobrenome_profissional = $servico_profissional['sobrenome'];
								$especialidade = $servico_profissional['especialidade'];
								$descricao = $servico_profissional['descricao'];
								$id_servico = $servico_profissional['id_servico'];
								$status = $servico_profissional['status'];
								$cep_profissional = $servico_profissional['cep'];
								$cidade_profissional = $servico_profissional['cidade'];
								$uf_profissional = $servico_profissional['uf'];
								$bairro_profissional = $servico_profissional['bairro'];
								$rua_profissional = $servico_profissional['rua'];
								$n_profissional = $servico_profissional['num'];
								$telefone_profissional = $servico_profissional['telefone'];
								$insta_profissional = $servico_profissional['insta'];
								$face_profissional = $servico_profissional['face'];
								$zap_profissional = $servico_profissional['whatsapp'];
							echo "<div class='col-4'>";
							echo 	"<img class='figure-img img-fluid rounded' src='../_icones/_tipo/sou_profissional.png' alt='' width='200' height='200'>";
							
							if($status == 'DISPONÍVEL'){
								echo "<img src='../_dashboard/_icones/disponivel.png' width='15' height='15'/>";
								echo "<span style='text-align: center; font-size: 15px; padding: 10px'>$status</span><br>";
							} else {
								echo "<img src='../_dashboard/_icones/indisponivel.png' width='15' height='15'/>";
								echo "<span style='text-align: center; font-size: 15px; padding: 10px'>$status</span><br>";
							}
							
							echo "</div>";
							echo "<div class='col perfil'>";
							echo 	"<span style='font-size: 30px; font-family: Verdana; color: #16578b; font-weight: bold; text-align: center;'>$especialidade</span><br>";
							echo 	"<span><b>Profissional: </b> $nome_profissional $sobrenome_profissional</span><br>";
							echo 	"<span><b>Regiões de Atendimento</b></span><br>";
							
							$sql_code = "SELECT * FROM regiao WHERE id_servico = '$id_servico'";
							$sql_query_regiao = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
							
							while ($regioesdeservico = mysqli_fetch_array($sql_query_regiao)){
								$regiao = $regioesdeservico['regiao'];
								$estado = $regioesdeservico['estado'];
								echo "<span style='font-family: Verdana; font-size: 16px;'>$regiao-$estado</span><br>";
							}
							
							$sql_code_avaliacao = "SELECT * FROM avaliacao WHERE id_servico = '$id_servico'";
							$sql_query_avaliacao = $mysqli->query($sql_code_avaliacao) or die("Falha na execução do código SQL" . $msqli->error);
							
							$quant_avaliacao = $sql_query_avaliacao->num_rows;
							
							if($quant_avaliacao=='0'){
								
							} else {
								
								$media = 0;
								$id = 0;
								
								while ($avaliacao = mysqli_fetch_array($sql_query_avaliacao)){
									$qualidade = $avaliacao['qualidade'];
									$media = $media + $qualidade;
									$id++;
								}
								$resultado = $media / $id;
								$resultado_format = number_format($resultado, 1, '.', '');
								
								echo "<div class='estrelas'>";
								echo "<span style='font-family: Verdana; font-size: 16px;'><b>Avaliação</b>:</span>";
									
								include_once('../_funcoes/avaliacao_estrelas.php'); 
								
								echo exibirAvaliacao($resultado);
								
								$sql_code_recomendacao = "SELECT * FROM avaliacao WHERE id_servico = '$id_servico' AND recomendacao = 'SIM'";
								$sql_query_recomendacao = $mysqli->query($sql_code_recomendacao) or die("Falha na execução do código SQL" . $msqli->error);
								
								$quant_recomendados = $sql_query_recomendacao->num_rows;
								
								$porcentagem = ($quant_recomendados/$quant_avaliacao)*100;
								
								echo 	"<span style='font-family: Verdana; font-size: 16px;'>$resultado_format</span><br>";
								
								
								echo "</div>";
							}
							
							echo "<br><a class='abutao' style='margin: 10px;' href='formasdecontato.php?cod_servico=$id_servico'>Formas de Contato</a>";							
							echo 	"</div>";				
							echo 	"<div class='row' style='text-align: center;'>";
							echo 		"<div class='col' style='margin: 10px;'>";
							echo 				"<span style='font-family: Verdana; font-size: 16px;'>$descricao</span><br>";
							echo 		"</div>";
							echo 	"</div>";
							echo 	"<div class='row'>";
							echo 		"<div class='col' style='text-align: right;'>";
							echo 			"<a class='abutaoeditar' style='margin: 10px;' href='..'>Voltar</a>";
							echo 		"</div>";
							echo 	"</div>";
							
							$sql_code_comentario = "SELECT * FROM avaliacao AS a JOIN usuario AS u ON a.id_usuario = u.id_usuario WHERE id_servico = '$id_servico'";
							$sql_query_comentario = $mysqli->query($sql_code_comentario) or die("Falha na execução do código SQL" . $msqli->error);
							
							$quant_comentarios = $sql_query_comentario->num_rows;
							
							if($quant_comentarios==1){
								echo "<span style='font-family: Verdana; font-size: 20px; text-align: left; margin: 20px;'><b>$quant_comentarios Comentário</b></span><br>";
							} else {
								echo "<span style='font-family: Verdana; font-size: 20px; text-align: left; margin: 20px;'><b>$quant_comentarios Comentários</b></span><br>";
							}
							echo "<div class='row embed-responsive embed-responsive-16by9'>";
							echo 	"<iframe class='embed-responsive-item' height='400' src='comentarios.php?cod_servico=$id_servico#comentarios'></iframe>";
							echo "</div>";
							
						}	
					?>
				</div>
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