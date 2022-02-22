<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Sobre - Services</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../_icones/icone.png"/>
		<link rel="stylesheet" href="../_css/menu.css"/>
		<link rel="stylesheet" href="../_css/footer.css"/>
		<link rel="stylesheet" href="../_css/aside.css"/>
		<link rel="stylesheet" href="../_css/funciona.css"/>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/1e592b5726.js" crossorigin="anonymous"></script>
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
														echo 			"<a class='abutao' style='margin: 10px;' href='../_dashboard/avaliacao/avaliando_servico.php?cont=$id_servico'>Avaliar</a>";
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
														echo 		"<div style='margin-top: -7px; margin-right: -10px; padding: 10px;'>";
														echo 			"<a class='abutaoexcluir' style='margin: 10px;' href='../_dashboard/avaliacao/manter_avaliacao.php?c=$id_servico'>Manter</a>";
														echo 			"<a class='abutao' style='margin: 10px;' href='../_dashboard/avaliacao/editar_avaliação.php?a=$id_avaliacao&s=$id_servico'>Editar Avaliação</a>";
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
				if(isset($_SESSION['id_adm'])){
					
					$nome_adm = $_SESSION['nome_adm'];
					
					echo "<div class='row'>";
					echo	"<ul class='nav justify-content-end'>";
					echo		"<li class='nav-item'>";
					echo			"<a class='nav-link' href='../_adm/adm003.php'><img class='navbar-brand' src='../_icones/painel.png' alt='' width='32' height='42'>$nome_adm | PAINEL DE CONTROLE</a>";
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
				<form class="d-flex justify-content-center pesquisa" method="get" action='busca.php'>
					<img class="logo" src="../_icones/icone_layout.png" width="170" height="42">
					<input class="form-control me-6" type="search" placeholder="Buscar profissionais" aria-label="Search" name="q">
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
						
						$ident = 1;
						
						while($selecionar_categorias = mysqli_fetch_array($sql_query_selecionar)){
							$categoria_nome = $selecionar_categorias['nome'];
							echo "<li><a class='dropdown-item' href='categorias.php?id=$ident'>$categoria_nome</a></li>";
							$ident++;
						}
					
					?>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="como_funciona.php">Como Funciona?</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="anuncie.php">Anuncie</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="sobre.php">Sobre</a>
				</li>
			</ul>
		</nav>
		</div>
	</nav>
</header>
	
	<div class="content wraper funciona">
		<div class="container justify-content-center">
			<div style="text-align: center;">
				<img class="img-fluid" src="../_icones/sobre.png" width="700" style="padding: 10px;"/>
			</div>
			<div class="row">
				<span style="font-size: 24px; font-family: Verdana; font-weight: bold; text-align: center; margin-bottom: 20px;">O que é o Services?</span>
			</div>
			<div class='row'>
				<div class="container justify-content-center" style="text-align: center; font-size: 17px; width: 600px;">
					<p style="text-align: center;"> O Services é uma plataforma de obtenção e anúncio de serviços que busca solucionar o problema da comunidade, no qual um morador precisa encontrar um profissional capaz de suprir suas necessidades ou para o próprio profissional que visa anunciar o seu serviço e atrair clientes.</p>
				</div>
			</div>
			<div class="row">
				<span style="font-size: 24px; font-family: Verdana; font-weight: bold; text-align: center; margin-bottom: 20px;">Qual a finalidade?</span>
			</div>
			<div class='row'>
				<div class="container justify-content-center" style="text-align: center; font-size: 17px; width: 600px;">
					<p style="text-align: center;"> O país possui um alto número de trabalhadores autônomos vivendo de seus serviços prestados que, na maioria dos casos, são pouco conhecidos e trabalham raramente. E o projeto foi pensado nessa situação, lutar pelo reconhecimento desses profissionais, lhes dando a devida importância, tornando-se a plataforma ideal para que possam encontrar clientes, anunciar serviços, receberem avaliações e ganhar notoriedade.</p>
				</div>
			</div>
			<div class="row">
				<span style="font-size: 24px; font-family: Verdana; font-weight: bold; text-align: center; margin-bottom: 20px;">Autores do projeto</span>
			</div>
			<div class='row'>
				<div class="container justify-content-center" style="text-align: center; font-size: 17px; width: 600px;">
					<p style="text-align: center;"> <b>O projeto foi desenvolvido para o Trabalho de Conclusão de Curso(TCC) dos alunos do IFPB - Campus Patos</b><br><i>Diego Araújo dos Santos</i><i><br>Emanuel Carlos Lucena da Nóbrega</i><br><br><b>Orietados pelo professor</b><br><i>Geam Carlos de Araújo Filgueira</i></p>
					<img class="img-fluid" src="../_icones/ifpb.jpg" width="400" style="padding: 10px;"/>
					<p style="font-size: 15px; text-align: right;"><br><i> "Nenhum obstáculo é tão grande se<br>sua vontade de vencer for maior." </i></p>
				</div>
			</div>
		</div>
	</div>
	
	<footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <h5>Inicio</h5>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="como_funciona.php">Como Funciona?</a></li>
                    </ul>
                </div>
                <div class="col-sm-2">
                    <h5>Sou profissional</h5>
                    <ul>
                        <li><a href="anuncie.php">Anuncie Aqui</a></li>
                    </ul>
                </div>
				<div class="col-sm-2">
                    <h5>Sobre-nós</h5>
                    <ul>
                        <li><a href="sobre.php">Informações</a></li>
                        <li><a href="">Contato</a></li>
                    </ul>
                </div>
				<div class="col-sm-2">
                    <h5>Suporte</h5>
                    <ul>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Telefones</a></li>
                        <li><a href="">Chat</a></li>
                    </ul>
                </div>
				<div class="col-sm-3 info">
                    <img style="padding: 10px;" class="img-fluid" src="../_icones/icone_layout.png" width="200" height="52">
                    <p> O Services é a plataforma que você precisa para encontrar o profissional ideal que possa suprir as suas necessidades.</p>
					<p> Anuncie seus serviços e se torne um dos melhores profissionais da sua região.</p>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© 2021 Copyright</p>
			<p>Diego Araújo dos Santos</p>
			<p>Emanuel Carlos Lucena da Nóbrega</p>
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