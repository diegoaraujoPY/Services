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
	
	if(!isset($_GET['cli'])){
		echo "<script>";
		echo 	"window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}
	
	if(!isset($_GET['con'])){
		echo "<script>";
		echo 	"window.location.replace('../../_paginas/login_usuario.php');";;
		echo "</script>";
	}

	$cod_servico = $_GET['c'];
	$id_usuario = $_GET['cli'];
	$id_contrato = $_GET['con'];
	$id_profissional = $_SESSION['id_usuario'];
	$hoje_fim = date('d/m/Y');
	$_SESSION['status'] = 'DISPONÍVEL';

	include("../../_conexao/conexao_login.php");
	
	$terminar_servico = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "INSERT INTO avalie (id_usuario, id_servico) VALUES ('$id_usuario', '$cod_servico')";
	mysqli_query($terminar_servico,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($terminar_servico);
	
	$data_fim = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql_fim = "UPDATE contrato SET data_final = '$hoje_fim' WHERE id_contrato = '$id_contrato'";
	mysqli_query($data_fim,$sql_fim) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($data_fim);
	
	$disponivel = mysqli_connect('localhost','root','','services') or die ("Erro ao se conectar ao Bando de Dados");
	$sql = "UPDATE profissional SET status = 'DISPONÍVEL' WHERE id_profissional = '$id_profissional'";
	mysqli_query($disponivel,$sql) or die ("Erro ao tentar cadastrar registro");
	mysqli_close($disponivel);

?>