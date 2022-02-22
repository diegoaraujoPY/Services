<?php

	if(!isset($_SESSION)){
		session_start();
	}
	
	if(!isset($_SESSION['id_usuario'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_profissional.php');";;
		echo "</script>";
	}
	
	if(isset($_SESSION['status'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Services</title>
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

<body style="background: #ffffff; overflow-x: hidden;">
<header>
			<?php
				
						
						$id_usuario = $_SESSION['id_usuario'];
						
						include("../../_conexao/conexao_profissional.php");
						
						$sql_code = "SELECT * FROM avaliacao AS a JOIN servico AS s ON a.id_servico = s.id_servico WHERE a.id_usuario = $id_usuario ORDER BY a._data DESC";
						$sql_query_historico = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $msqli->error);
			
						while ($historico = mysqli_fetch_array($sql_query_historico)){
								$id_servico = $historico['id_servico'];
								$comentario = $historico['comentario'];
								$data_avaliacao = $historico['_data'];
							
							$sql_code_servico = "SELECT * FROM servico AS s JOIN profissional AS p ON s.id_profissional = p.id_profissional WHERE s.id_servico = '$id_servico'";
							$sql_query_servico = $mysqli->query($sql_code_servico) or die("Falha na execução do código SQL" . $msqli->error);
								
								while ($servico = mysqli_fetch_array($sql_query_servico)){
									$especialidade = $servico['especialidade'];
									$media = $servico['nota'];
									$nome_profissional = $servico['nome'];
									$sobrenome_profissional = $servico['sobrenome'];
										
										$qualidade_format = number_format($media, 1, '.', '');
										
										echo 	"<div class='row' style='text-align: left;' id='historico'>";
										echo 		"<div class='col-2'>";
										echo 			"<img class='figure-img img-fluid rounded' src='../../_icones/_tipo/sou_profissional.png' alt='' width='200' height='200'>";
										echo 		"</div>";
										echo 		"<div class='col estrelas' style='margin: 10px; font-size: 12px;'>";
										echo 				"<span style='font-family: Verdana; font-size: 20px;'><b>Serviço: </b>$especialidade</span><br>";
										echo 				"<span style='font-family: Verdana; font-size: 12px;'><b>Profissional: </b>$nome_profissional $sobrenome_profissional</span><br>";
									
										include_once('../../_funcoes/avaliacao_estrelas.php'); 
										
										echo 				"<span style='font-family: Verdana; font-size: 12px;'><b>Concluído em: </b>$data_avaliacao</span><br>";
										
										echo exibirAvaliacao($media);
										
										echo 				"<span style='font-family: Verdana; font-size: 12px;'>$qualidade_format</span><br>";
										echo 		"</div>";
										echo 	"</div>";
								}
							
							
						}
					
				?>
			</div>
			</div>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>