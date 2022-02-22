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
	
	if(!isset($_GET['c'])){
		echo "<script>";
		echo "window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}

	include("../../_conexao/conexao_login.php");

	$cod_servico = $_GET['c'];
	$hoje = date('d/m/Y');
	
	$listar_servico = "SELECT * FROM profissional AS p JOIN servico AS s ON p.id_profissional = s.id_profissional WHERE s.id_servico = '$cod_servico'";
	$sql_query_servico = $mysqli->query($listar_servico) or die("Falha na execução do código SQL" . $msqli->error);
	
	while ($servico = mysqli_fetch_array($sql_query_servico)){
		$id_usuario = $servico['aceitar'];
		$id_profissional = $servico['id_profissional'];
	}
	
	$aceitar_solicitacao = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "INSERT INTO contrato (id_usuario, id_servico, data, data_final) VALUES ($id_usuario, $cod_servico, '$hoje', '0')";
	mysqli_query($aceitar_solicitacao,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($aceitar_solicitacao);
	
	$excluir_solicitacao = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE servico SET aceitar = 0 WHERE id_servico = '$cod_servico'";
	mysqli_query($excluir_solicitacao,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($excluir_solicitacao);
	
	$indisponivel = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE profissional SET status = 'INDISPONÍVEL' WHERE id_profissional = '$id_profissional'";
	mysqli_query($indisponivel,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($indisponivel);
	
	$_SESSION['status'] = 'INDISPONÍVEL';
	

?>