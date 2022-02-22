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
	
	$id_usuario = $_SESSION['id_usuario'];
	$cod_servico = $_GET['c'];
	$hoje = 0;
	
	$listar_servico = "SELECT * FROM profissional AS p JOIN servico AS s ON p.id_profissional = s.id_profissional WHERE s.id_servico = '$cod_servico'";
	$sql_query_servico = $mysqli->query($listar_servico) or die("Falha na execução do código SQL" . $msqli->error);
	
	while ($servico = mysqli_fetch_array($sql_query_servico)){
		$id_profissional = $servico['id_profissional'];
	}
	
	$cancelar_servico = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE contrato SET data = '0', data_final = '1' WHERE id_servico = '$cod_servico' AND id_usuario = '$id_usuario'";
	mysqli_query($cancelar_servico,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($cancelar_servico);
	
	$disponivel = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE profissional SET status = 'DISPONÍVEL' WHERE id_profissional = '$id_profissional'";
	mysqli_query($disponivel,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($disponivel);
	

?>