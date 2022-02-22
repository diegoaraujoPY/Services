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

<body style="background: #ffffff; overflow-x: hidden;">
<header>
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
							
							
								$sql_code_comentario = "SELECT * FROM avaliacao AS a JOIN usuario AS u ON a.id_usuario = u.id_usuario WHERE id_servico = '$id_servico'";
								$sql_query_comentario = $mysqli->query($sql_code_comentario) or die("Falha na execução do código SQL" . $msqli->error);
								
								$quant_comentarios = $sql_query_comentario->num_rows;
								
								while ($avaliacao = mysqli_fetch_array($sql_query_comentario)){
										$comentario = $avaliacao['comentario'];
										$nome_usuario = $avaliacao['nome'];
										$data_avaliacao = $avaliacao['_data'];
										$sobrenome_usuario = $avaliacao['sobrenome'];
										$qualidade_usuario = $avaliacao['qualidade'];
										$recomendacao_usuario = $avaliacao['recomendacao'];
										
										$qualidade_format = number_format($qualidade_usuario, 1, '.', '');
										
										echo 	"<div class='row' style='text-align: left;' id='comentarios'>";
										echo 		"<div class='col-2'>";
										echo 			"<img class='figure-img img-fluid rounded' src='../_icones/_tipo/sou_usuario.png' alt='' width='200' height='200'>";
										echo 		"</div>";
										echo 		"<div class='col estrelas' style='margin: 10px; font-size: 12px;'>";
										echo 				"<span style='font-family: Verdana; font-size: 16px;'>$nome_usuario $sobrenome_usuario</span><br>";
										echo 				"<span style='font-family: Verdana; font-size: 12px; margin: 10px;'>$comentario</span><br>";
									
										include_once('../_funcoes/avaliacao_estrelas.php'); 
									
										echo exibirAvaliacao($qualidade_usuario);
										
										echo 				"<span style='font-family: Verdana; font-size: 12px;'>$qualidade_format</span><br>";
										
										
											if($recomendacao_usuario=='SIM'){
												echo  "<span style='font-family: Verdana; font-size: 12px;'><b>Recomendo esse serviço  </b></span><img class='figure-img img-fluid rounded' src='../_icones/recomendo.png' alt='' width='30' height='30'><br>";
											} else {
												echo  "<span style='font-family: Verdana; font-size: 12px;'><b>Não recomendo esse serviço  </b></span><img class='figure-img img-fluid rounded' src='../_icones/naorecomendo.png' alt='' width='30' height='30'><br>";
											}
										
										echo 				"<span style='font-family: Verdana; font-size: 12px;'><b>Avaliado: </b>$data_avaliacao</span><br>";
										echo 		"</div>";
										echo 	"</div>";
								}
							
							
						}	
					?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>