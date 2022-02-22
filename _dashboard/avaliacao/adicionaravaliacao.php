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
	
	if(!isset($_POST['estrela'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}
	
	$qualidade = $_POST['estrela'];
	$comentario = $_POST['comentario'];
	$recomendo = $_POST['recomendo'];
	$hoje_avalie = date('d/m/Y');
	$id_usuario = $_SESSION['id_usuario'];
	$id_servico = $_SESSION['servico'];
	
	$adicionar_avaliacao = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "INSERT INTO avaliacao (id_usuario, id_servico, _data, qualidade, comentario, recomendacao) VALUES ('$id_usuario', '$id_servico', '$hoje_avalie', '$qualidade', '$comentario', '$recomendo')";
	mysqli_query($adicionar_avaliacao,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($adicionar_avaliacao);
	
	$excluir_avalie = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "DELETE FROM avalie WHERE id_usuario = $id_usuario AND id_servico = $id_servico";
	mysqli_query($excluir_avalie,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_avalie);
	
	$excluir_contrato = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "DELETE FROM contrato WHERE id_servico = $id_servico AND id_usuario = $id_usuario";
	mysqli_query($excluir_contrato,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_contrato);
	
	include('../../_conexao/conexao_login.php');
	
	$sql_code_avaliacao = "SELECT * FROM avaliacao WHERE id_servico = $id_servico";
	$sql_query_avaliacao = $mysqli->query($sql_code_avaliacao) or die("Falha na execução do código SQL" . $msqli->error);
							
	$quant_avaliacao = $sql_query_avaliacao->num_rows;
							
	$media = 0;
	$id = 0;
	
	while ($avaliacao = mysqli_fetch_array($sql_query_avaliacao)){
		$qualidade_no_banco = $avaliacao['qualidade'];
		$media = $media + $qualidade_no_banco;
		$id++;
	}
		
	$resultado = $media/$id;
	
	$adicionar_nota = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE servico SET nota = '$resultado' WHERE id_servico = $id_servico";
	mysqli_query($adicionar_nota,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($adicionar_nota);
	
	echo "<script>";
	echo "window.location.replace('../main_usuario.php');";;
	echo "</script>";

?>